<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestWordRequest extends FormRequest
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
        $rules = [
            'en_correct_text' => 'required|string|max:255',
            'en_incorrect_text' => 'required|string|max:255',
            'translations_word.*' => 'required|string|max:255',
            'chapter_id' => 'required|exists:chapters,id',
            'lesson_id' => 'required|exists:lessons,id', 
            'status' => 'nullable',
            'order' => 'nullable|integer'        
        ];

        if(request()->isMethod("POST")) {
            $rules['audio'] = 'required|file|mimes:mp3,mp4,m4a|max:10240';
        }else{
            $rules['audio'] = 'nullable|file|mimes:mp3,mp4,m4a|max:10240';
        }


        return $rules;
    }
}
