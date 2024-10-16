<?php

namespace App\Livewire\Create;

use App\Models\Chapter;
use App\Models\Language;
use App\Models\Lesson;
use App\Models\List_exercise;
use Livewire\Component;

class PronunciationCreate extends Component
{
    public $audioInputs = [1];

    public $locales, $chapters, $lessons=null;
    public $selectedChapter, $selectedLesson;

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
        $this->chapters = Chapter::whereHas('lesson')->orderBy('order')->get();
        $this->locales = Language::where("status",1)->orderBy('order')->get();
        return view('livewire.create.pronunciation-create');
    }

    public function selectedChapterHandle()
    {
        $this->exercises = null;
        $this->lessons = Lesson::where('chapter_id',$this->selectedChapter)->orderBy('order')->get(); 
    }


    public function addInput()
    {
        $this->audioInputs[] = count($this->audioInputs) + 1;
    }

    // Method to remove an input if needed
    public function removeInput($index)
    {
        unset($this->audioInputs[$index]);
        $this->audioInputs = array_values($this->audioInputs); // Re-index the array
    }
}
