<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=> $this->id,
            // "correct_text" => $this->correct_text,
            // "incorrect_text" => $this->incorrect_text,
            "correct_translations" => $this->getTranslations('translation_correct_words'),           
            "incorrect_translations" => $this->getTranslations('translation_incorrect_words'), 
            'image' => $this->getImage(),
            'audio' => $this->getAudio(),            
            "chapter_id" => $this->chapter_id,
            "lesson_id" => $this->lesson_id,
            "exercise_id" => $this->exercise_id,
            // "type_id" => $this->type_id
        ];
    }
}
