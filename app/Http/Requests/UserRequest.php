<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $rule_email_unique = Rule::unique('users', 'email');
        if ($this->method() !== 'POST') {
            $rule_email_unique->ignore($this->route()->parameter('id'));
        }
        return [
            'name' => ['required'],
            'email' => ['required', $rule_email_unique],
            'role' => ['required',],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required.!',
            'email.required' => 'Email is required.!',
            'email.unique' => 'Email already taken.!',
            'password.required' => 'Password is required.!',
            'password.min' => 'Password minimum 3 character.!',
            'role.required' => 'Role is required.!',
        ];
    }
}
