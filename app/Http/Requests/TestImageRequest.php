<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestImageRequest extends FormRequest
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
            'chapter_id' => 'required|exists:chapters,id',
            'lesson_id' => 'required|exists:lessons,id',
            'status' => 'nullable',
            'order' => 'nullable|integer'
        ];


        if(request()->isMethod("POST")) {
            $rules['correct_image'] = 'required|file|mimes:webp,jpeg,png,jpg,gif,svg|max:10240';
            $rules['incorrect_image'] = 'required|file|mimes:webp,jpeg,png,jpg,gif,svg|max:10240';
            $rules['audio'] = 'required|file|mimes:mp3,mp4,m4a|max:10240';
        }else{
            $rules['correct_image'] = 'nullable|file|mimes:webp,jpeg,png,jpg,gif,svg|max:10240';
            $rules['incorrect_image'] = 'nullable|file|mimes:webp,jpeg,png,jpg,gif,svg|max:10240';
            $rules['audio'] = 'nullable|file|mimes:mp3,mp4,m4a|max:10240';
        }

        return $rules;
    }
}