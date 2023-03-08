<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PageRequest extends FormRequest
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
        $rule_title_unique = Rule::unique('pages', 'title');
        if ($this->method() !== 'POST') {
            $rule_title_unique->ignore($this->route()->parameter('id'));
        }
        return [
            'title' => ['required', 'min:3', $rule_title_unique],
            'content' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title is required.!',
            'title.min' => 'Title minimum 3 character.!',
            'title.unique' => 'Title already taken.!',
            'content.required' => 'Title is required.!',
        ];
    }
}
