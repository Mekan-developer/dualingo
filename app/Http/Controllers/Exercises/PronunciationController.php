<?php

namespace App\Http\Controllers\Exercises;

use App\Http\Controllers\Controller;
use App\Http\Requests\PronunciationRequest;
use App\Models\Lesson;
use App\Models\List_exercise;
use App\Models\Pronunciation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;

class PronunciationController extends Controller
{
    public function index(Request $request){
        $pronunciations = Pronunciation::orderBy('order');
        $data = $this->selectOPtionOrderExercise($request,$pronunciations,'pronunciations');
        $audioCounts = DB::table('pronunciations')->selectRaw('MAX(JSON_LENGTH(audio)) as max_length')->value('max_length');

        return view("pages.allExercises.pronunciation.index", $data,compact('audioCounts'));
    }

    public function create(){
        return view("pages.allExercises.pronunciation.create");
    }

    public function store(PronunciationRequest $request){

         $data = $request->all();
        if ($request->hasFile('audio')) {
            $counter = 0;
            foreach($request->audio as $audio){
                $counter++;
                $random = hexdec(uniqid());
                $filename = $random . '.' . $audio->extension();
                Storage::disk('pronunciation')->putFileAs('', $audio,$filename);
                $audioFiles[$counter] = $filename;
            }
        }

        $data['audio'] = $audioFiles;
        Pronunciation::create($data);
        return redirect()->route('pronunciation.index')->with('success','Pronunciation created sccessfully!');    
    }

    public function edit(Pronunciation $pronunciation){ 

        $lessons = Lesson::where('chapter_id', $pronunciation->chapter_id)->orderBy('order')->get();
        $exercises = List_exercise::where('lesson_id', $pronunciation->lesson_id)->orderBy('order')->get();

        return view("pages.allExercises.pronunciation.edit")->with("pronunciation",$pronunciation)->with("lessons",$lessons)->with("exercises", $exercises);
     }

     public function update(PronunciationRequest $request, Pronunciation $pronunciation){ 
        $pronunciationAudio = $pronunciation->audio;
        $pronunciations = Pronunciation::all();

        $this->sortItems($pronunciations, $pronunciation->order, $request->order);

        $data = $request->all();
        if ($request->hasFile('audio') && $request->audio != null) {             
            foreach($request->audio as $requestKey => $audio){
                if ($pronunciation->audio) {
                    foreach($pronunciation->audio as $key => $value){
                        if($requestKey == $key){
                            $this->removeFile($value, 'pronunciation');
                            unset($pronunciationAudio[$key]);

                            $random = hexdec(uniqid());
                            $filename = $random . '.' . $audio->extension();
                            Storage::disk('pronunciation')->putFileAs('', $audio,$filename);
                            $pronunciationAudio[$key] = $filename;
                            goto end;
                        }    
                    }  
                } 
                $random = hexdec(uniqid());
                $filename = $random . '.' . $audio->extension();
                Storage::disk('pronunciation')->putFileAs('', $audio,$filename);
                $pronunciationAudio[$requestKey] = $filename;
                end:
            }  
                          
        }else{
            $removingAudioIds = json_decode($request->removeIds);
            if(!empty($removingAudioIds)){
                foreach($removingAudioIds as $key){
                    $this->removeFile($pronunciationAudio[$key], 'pronunciation');
                    unset($pronunciationAudio[$key]); //$audio = [1 => 'sadsad.mp3' 2 => 'asdsadsa.mp3', 3 => 'sadsad.mp3', 4 => 'asdsadsa.mp3']
                }
                $pronunciationAudio = array_combine(range(1, count($pronunciationAudio)), array_values($pronunciationAudio));
            }
        }
        $data['audio'] = $pronunciationAudio; 

        $pronunciation->update($data);
        return redirect()->route('pronunciation.index')->with('success','Pronunciation updated sccessfully!'); 
     }

     public function destroy(Pronunciation $pronunciation){
        if ($pronunciation->audio) {
            foreach($pronunciation->audio as $key => $value){
                $this->removeFile($value, 'pronunciation');
            }            
        } 
        $orderDeletedRow = $pronunciation->order;
        $delete_success = $pronunciation->delete();

        // sorting order
        if( $delete_success ){
            $table = Pronunciation::orderBy('order', 'asc')->get();
            $this->reorderAfterRemoval($table,$orderDeletedRow);
        }

        return redirect()->route('pronunciation.index')->with('success','Pronunciation deleted successfully');
    }

    public function active(Pronunciation $pronunciation){

        if($pronunciation->status == '1'){
            $pronunciation->status = '0';
        }else{
            $pronunciation->status = '1';
        }
            $pronunciation->save();

        return redirect()->route('pronunciation.index');
    }
}
