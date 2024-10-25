<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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
            "en_words" => $this->en_words,
            'translation_words' => $this->translation_words,         
            "chapter_id" => $this->chapter_id,
            "lesson_id" => $this->lesson_id,
        ];
    }
}
