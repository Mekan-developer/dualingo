<?php

namespace App\Livewire\Create;

use App\Models\Chapter;
use App\Models\Language;
use App\Models\Lesson;
use Livewire\Component;

class ReviewCreate extends Component
{
    public $locales, $lessons=null,$exercises = null;
    public $selectedChapter, $selectedLesson,$count;


    public function mount(){
        if (session()->hasOldInput('chapter_id') && old('chapter_id') > 0) {
            $this->selectedChapter = old('chapter_id');
            $this->selectedChapterHandle();
        }
        if (session()->hasOldInput('lesson_id') && old('lesson_id') > 0) {
            $this->selectedLesson = old('lesson_id');
        }
    }

    public function render()
    {
        $chapters = Chapter::whereHas('lessonsForReview')->orderBy('order')->get();
        $this->locales = Language::where("status",1)->orderBy('order')->get();

        return view('livewire.create.review-create',[
            'chapters'=> $chapters,
        ]);
    }


    public function selectedChapterHandle()
    {
        $this->lessons = Lesson::where('chapter_id',$this->selectedChapter)->where('review',1)->orderBy('order')->get(); 
    }

    public function hydrated(){
        if (session()->hasOldInput('chapter_id') && old('chapter_id') > 0) {
            $this->selectedChapter = old('chapter_id');
            $this->selectedChapterHandle();
        }
        if (session()->hasOldInput('lesson_id') && old('lesson_id') > 0) {
            $this->selectedLesson = old('lesson_id');
        }
    }

    
}
