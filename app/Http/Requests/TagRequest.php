<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'min:3', 'unique:tags']
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title is required.!',
            'title.min' => 'Title minimum 3 character.!',
            'title.unique' => 'Title already taken.!',
        ];
    }
}
