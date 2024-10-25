<?php

namespace App\Livewire\Edit;

use App\Models\Chapter;
use App\Models\Language;
use App\Models\Lesson;
use App\Models\List_exercise;
use App\Models\Pronunciation;
use Livewire\Component;

class PronunciationEdit extends Component
{
    public $audioInputcounts = null,$audioInputs = null,$removeIds = [];
    public $pronunciation,$lessons,$lesson_id;
    public $selectedChapter = null,$selectedLesson = null;
    public $switch_lesson = false;

    public function mount($pronunciation,$lessons)
    {
        $this->audioInputs = $pronunciation->audio;
        $this->pronunciation = $pronunciation;
        $count = count($pronunciation->audio);

        $this->audioInputcounts = $count;
        // $this->removedIdCounts = 1;

        $this->selectedLesson = $pronunciation->lesson_id;
        $this->selectedChapter = $pronunciation->chapter_id;
        $this->lessons = $lessons;
    }
    public function render()
    {
        $chapters = Chapter::whereHas('lesson')->orderBy("order")->get();
        $locales = Language::orderBy("order")->get();
        $pronunciations = Pronunciation::orderBy("order")->get();

        return view('livewire.edit.pronunciation-edit',[
            "pronunciations" => $pronunciations,
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
        $this->lessons = Lesson::where('chapter_id',$this->selectedChapter)->orderBy('order')->get();

    }

    public function addInput()
    {
        $this->audioInputcounts = $this->audioInputcounts + 1;
    }

    // Method to remove an input if needed
    public function removeInput($index)
    {
        $this->removeIds[] = $index;
        // unset($this->audioInputs[$index]);
        $this->audioInputcounts = $this->audioInputcounts - 1;

        // $this->removedIdCounts++;
    }
}
