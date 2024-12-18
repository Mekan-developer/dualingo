<?php

namespace App\Http\Controllers\Exercises;

use App\Http\Controllers\Controller;
use App\Http\Requests\SpellingRequest;
use App\Models\Language;
use App\Models\Lesson;
use App\Models\List_exercise;
use App\Models\Spelling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SpellingController extends Controller
{
    public function index(Request $request) {
        $spellings = Spelling::orderBy('order');
        $data = $this->selectOPtionOrderExercise($request,$spellings,'spellings');

        return view("pages.allExercises.spelling.index", $data);
    }


    public function create() {
        $locales = Language::where("status",1)->orderBy('order')->get();

        return view("pages.allExercises.spelling.create", compact("locales"));
    }

    public function store(SpellingRequest $request) {
        $data = $request->all();
        if ($request->hasFile('audio')) {
            $random = hexdec(uniqid());
            $filename = $random . '.' . $request->audio->extension();
            Storage::disk('spelling_audio')->putFileAs('', $request->audio,$filename);
            $data['audio'] = $filename;
        }

        Spelling::create($data);
        return redirect()->route('spelling.index')->with('success','spelling word created successfully!');
    }

    public function edit(Spelling $spelling){
        $lessons = Lesson::where('chapter_id', $spelling->chapter_id)->orderBy('order')->get();
        return view("pages.allExercises.spelling.edit")->with("spelling",$spelling)->with("lessons",$lessons);
    }

    public function update(SpellingRequest $request, Spelling $spelling) {
        $spellings = Spelling::all();
        $this->sortItems($spellings, $spelling->order, $request->order);

        $data = $request->all();
        if ($request->hasFile('audio')) {
            if ($spelling->audio) 
                $this->removeFile($spelling->audio, 'spelling/audio');
            $random = hexdec(uniqid());
            $filename = $random . '.' . $request->audio->extension();
            Storage::disk('spelling_audio')->putFileAs('', $request->audio,$filename);
            $data['audio'] = $filename;
        }

        $spelling->update($data);
        return redirect()->route('spelling.index')->with('success','spelling word updated successfully!');
    }

    public function destroy(Spelling $spelling){ 
        if ($spelling->audio) {
            $this->removeFile($spelling->audio, 'spelling/audio');
        } 

        $orderDeletedRow = $spelling->order;
        $delete_success = $spelling->delete();

        // sorting order
        if( $delete_success ){
            $table = Spelling::orderBy('order', 'asc')->get();
            $this->reorderAfterRemoval($table,$orderDeletedRow);
        }

        return redirect()->route('spelling.index')->with('success','spelling word deleted successfully');
    }

    public function active(Spelling $spelling){

        if($spelling->status == '1'){
            $spelling->status = '0';
        }else{
            $spelling->status = '1';
        }
            $spelling->save();

        return redirect()->route('spelling.index');
    }
}
