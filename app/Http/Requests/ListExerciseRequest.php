<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListExerciseRequest extends FormRequest
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
        return [
            'lesson_id' => 'required|exists:lessons,id',
            'chapter_id' => 'required|exists:chapters,id',
            'name' => 'required|string|max:255',
        ];
    }
}
