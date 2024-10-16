<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // $this->en_text = json_encode($this->en_text);
        // $this->translation_words = json_encode($this->translation_words);
  
        $rules = [
            'en_words' => 'required|array|max:255',
            'translation_words' => 'required|array|max:255',
            'chapter_id' => 'required|exists:chapters,id',
            'lesson_id' => 'required|exists:lessons,id',
            'status' => 'nullable',
            'order' => 'nullable|integer'
        ];

        return $rules;
    }
}
