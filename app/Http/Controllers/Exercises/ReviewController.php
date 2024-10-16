<?php

namespace App\Http\Controllers\Exercises;

use App\Http\Requests\ReviewRequest;
use App\Models\Language;
use App\Models\Lesson;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    public function index(Request $request) {       
        $reviews = Review::orderBy('order');
        $data = $this->selectOPtionOrderExercise($request,$reviews,'reviews');

        return view("pages.allExercises.review.index",$data);
    }

    public function create() {
        $locales = Language::where("status",1)->orderBy('order')->get();

        return view("pages.allExercises.review.create", compact("locales"));
    }

    public function store(ReviewRequest $request) {     
        $data = $request->all();

        Review::create($data);
        return redirect()->route('review.index')->with('success','Review created successfully!');
    }


    public function edit(Review $review) {
        $lessons = Lesson::where('chapter_id', $review->chapter_id)->where('review',1)->orderBy('order')->get();

        return view("pages.allExercises.review.edit")->with("review",$review)->with("lessons",$lessons);
    }


    public function update(ReviewRequest $request, Review $review) {  
        
        $reviews = Review::all();
        $this->sortItems($reviews, $review->order, $request->order);

        $data = $request->all();
    
        $review->update($data);

        return redirect()->route('review.index')->with('success','review updated successfully!');
    }



    public function destroy(Review $review){
        $orderDeletedRow = $review->order;
        $delete_success = $review->delete();

        // sorting order
        if( $delete_success ){
            $table = Review::orderBy('order', 'asc')->get();
            $this->reorderAfterRemoval($table,$orderDeletedRow);
        }
        return redirect()->route('review.index')->with('success','review deleted successfully');
     }

    public function active(Review $review){
        if($review->status == '1'){
            $review->status = '0';
        }else{
            $review->status = '1';
        }
            $review->save();

        return redirect()->route('review.index');
    }

}
