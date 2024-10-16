<?php

namespace App\Http\Controllers;

use App\Http\Requests\LessonRequest;
use App\Models\Chapter;
use App\Models\Language;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index(Request $request){
        $chapters = Chapter::orderBy('order')->get(); 

        $locales = Language::where("status",1)->get("locale");

        if($request->has('sort_by') && $request->sort_by > 0 ){
            $lessons = Lesson::where('chapter_id',$request->sort_by)->orderBy("order")->with('chapter')->paginate(10);
        }else{
            $lessons = Lesson::orderBy("order")->with('chapter')->paginate(10);
        }
        return view("pages.lessons.index", compact("locales","lessons","chapters"));
    }

    public function create(){ 
        $chapters = Chapter::orderBy('order')->get(); 
        $locales = Language::where("status",1)->orderBy('order')->get();

        return view("pages.lessons.create", compact("locales","chapters"));
    }

    public function store(LessonRequest $request){ 

        $data = [
            'name' => $request->name,
            'review' => filter_var($request->input('review', false), FILTER_VALIDATE_BOOLEAN),
            'chapter_id' => $request->chapter_id,
        ];

        Lesson::create($data);  
        return redirect()->route('lessons')->with('success','Lesson created successfully!');
    }

    public function edit(Lesson $lesson){
        $chapters = Chapter::orderBy('order')->get(); 
        $lessons = Lesson::orderBy("order")->get();
        $locales = Language::where("status",1)->orderBy('order')->get();

        return view('pages.lessons.edit', compact('locales','chapters','lesson','lessons'));
    }

    public function update(LessonRequest $request, Lesson $lesson){ 

        
        $data = [
            'chapter_id' => $request->chapter_id,
            'name' => $request->name,
            'review' => filter_var($request->input('review', false), FILTER_VALIDATE_BOOLEAN),
            'order' => $request->order
        ];
        $lessons = Lesson::all();
        $this->sortItems($lessons, $lesson->order, $request->order);

        $lesson->update($data);
        return redirect()->route('lessons')->with('success','Lesson updated successfully!');
    }


    public function destroy(Lesson $lesson){
        // checking has or no child exercise
        // dd($lesson->exerciseType2()->exists());
        if($lesson->exerciseType1()->exists() || $lesson->exerciseType2()->exists() || $lesson->exerciseType3()->exists() || $lesson->exerciseType4()->exists() || $lesson->exerciseType5()->exists() || $lesson->exerciseType6()->exists() || $lesson->exerciseType7()->exists() || $lesson->exerciseType8()->exists() || $lesson->exerciseType9()->exists() || $lesson->exerciseType10()->exists() || $lesson->exerciseType11()->exists()){
            return redirect()->route('lessons')->with('alert','Lesson has exercise and cannot be deleted.');
        }

        $orderDeletedRow = $lesson->order;
        $delete_success = $lesson->delete();

        // sorting order
        if( $delete_success ){
            $table = Chapter::orderBy('order', 'asc')->get();
            $this->reorderAfterRemoval($table,$orderDeletedRow);
        }
        // end sorting order

        return redirect()->route('lessons')->with('success','Lesson deleted successfully!');
    }
}
