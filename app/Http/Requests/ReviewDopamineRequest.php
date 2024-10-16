<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewDopamineRequest extends FormRequest
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
            'dopamine1' => 'nullable|file|max:10240',
            'dopamine2' => 'nullable|file|max:10240',
            'dopamine3' => 'nullable|file|max:10240',
            'audio' => 'nullable|file|mimes:mp3,mp4,m4a|max:10240',
        ];
    }
}
