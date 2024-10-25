<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExerciseRequest;
use App\Http\Requests\ReviewDopamineRequest;
use App\Models\Exercise;
use App\Models\ReviewDephomine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExerciseController extends Controller
{
    public function index(){
        $gotoLinks = [       
                1 => 'vocabulary.index',
                2 => 'questionWord.index',
                3 => 'video.index',
                4 => 'audioTranslation.index',
                5 => 'questionImage.index',
                6 => 'spelling.index',
                7 => 'pronunciation.index',
                8 => 'grammar.index',
                9 => 'testImage.index',
                10 => 'testWord.index',
                11 => 'listening.index',
          
        ];
        $exercises = Exercise::orderBy('order')->get();
        $reviewDephomine = ReviewDephomine::first();
        return view('pages.exercises.index',['exercises' => $exercises,'reviewDephomine' => $reviewDephomine, 'gotoLinks' => $gotoLinks]);
    }

    public function edit(Exercise $exercise){
        $exercises = Exercise::orderBy("order")->get();

        return view('pages.exercises.edit', compact('exercise','exercises'));
    }

    public function editReviewDopamine(ReviewDephomine $reviewDephomine){


        // $reviewDephomine = Exercise::orderBy("order")->get();

        return view('pages.exercises.reviewDopamine', compact('reviewDephomine'));
    }

    

    public function update(ExerciseRequest $request,Exercise $exercise){
        $exercises = Exercise::all();
        $this->sortItems($exercises, $exercise->order, $request->order);

        $data = $request->all();
        if ($request->hasFile('image')) { 
            if ($exercise->image) 
                $this->removeFile($exercise->image, 'exercises/dephomine');       
            // $image = $request->image;
            

            $random = hexdec(uniqid());
            $imageName = $random . '.' . 'json';
            Storage::disk('json')->putFileAs('', $request->image,$imageName);
            // $imageName = $this->uploadFile($image,'exercises/dephomine');
            $data['image'] = $imageName;
        }
        if ($request->hasFile('audio')) {
            if ($exercise->audio) 
                $this->removeFile($exercise->audio, 'exercises/audio');
            $random = hexdec(uniqid());
            $filename = $random . '.' . $request->audio->extension();
            Storage::disk('exercises_audio')->putFileAs('', $request->audio,$filename);
            $data['audio'] = $filename;
        }


        $exercise->update($data);

        return redirect()->route('exercises')->with('success','exercise updated successfully!');
    }


    public function reviewDopamineUpdate(ReviewDopamineRequest $request,ReviewDephomine $reviewDephomine){
        $data = $request->all();
        foreach (range(1, 3) as $i) {
            $field = 'dopamine' . $i;
        
            if ($request->hasFile($field)) {
                if ($reviewDephomine->$field) {
                    $this->removeFile($reviewDephomine->$field, 'exercises/dephomine');
                }
                
                $random = hexdec(uniqid());
                $imageName = $random . '.' . 'json';
                Storage::disk('json')->putFileAs('', $request->$field, $imageName);
                $data[$field] = $imageName;
            }
        }
        
        if ($request->hasFile('audio')) {
            if ($reviewDephomine->audio) 
                $this->removeFile($reviewDephomine->audio, 'exercises/audio');
            $random = hexdec(uniqid());
            $filename = $random . '.' . $request->audio->extension();
            Storage::disk('exercises_audio')->putFileAs('', $request->audio,$filename);
            $data['audio'] = $filename;
        }


        $reviewDephomine->update($data);

        return redirect()->route('exercises')->with('success','exercise updated successfully!');
    }
}
