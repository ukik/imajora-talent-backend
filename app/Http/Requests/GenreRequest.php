<?php

namespace App\Http\Requests;

use App\Models\Genre;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GenreRequest extends FormRequest
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
        $rule_title_unique = Rule::unique('genres', 'title');
        if ($this->method() !== 'POST') {
            $rule_title_unique->ignore($this->route()->parameter('id'));
        }
        return [
            'title' => ['required', 'min:3', $rule_title_unique]
        ];
    }
}
