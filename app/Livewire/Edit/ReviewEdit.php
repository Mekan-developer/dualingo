<?php

namespace App\Livewire\Edit;

use App\Models\Chapter;
use App\Models\Language;
use App\Models\Lesson;
use App\Models\Review;
use Livewire\Component;

class ReviewEdit extends Component
{
    public $review,$lessons,$lesson_id,$exercise_id,$selectedReviewLesson;

    public $selectedChapter = null,$selectedLesson = null;
    public $switch_lesson = false, $switch_exercise = false;

    public function mount($review , $lessons){
        $this->review = $review;
        $this->selectedLesson = $review->lesson_id;
        $this->exercise_id = $review->exercise_id;
        $this->selectedChapter = $review->chapter_id;

        $this->lessons = $lessons;
    }





    public function render()
    {

        $chapters = Chapter::whereHas('lessonsForReview')->orderBy("order")->get();
        $locales = Language::orderBy("order")->get();

        $reviews = Review::orderBy("order")->get();
        return view('livewire.edit.review-edit',[
            "reviews" => $reviews,
            "chapters" => $chapters,
            "lessons" => $this->lessons,
            "locales" => $locales
        ]);
    }

    public function selectedChapterHandle()
    {
        $this->selectedLesson = null;
        $this->switch_lesson = true;
        $this->lesson_id = null;
        $this->exercise_id = null;
        $this->lessons = Lesson::where('chapter_id',$this->selectedChapter)->where('review',1)->orderBy('order')->get();

    }

    public function switchExerciseChange(){
        $this->switch_exercise = false;
    }
}
