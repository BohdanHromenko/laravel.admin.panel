<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminUserEditRequest extends FormRequest
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
        $id = $_POST['id'];

        $rules = [
            'name' => 'required|min:3|max:20|string',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($id),
            ],
            'password' => 'nullable|string|min:8|max:20|confirmed',
        ];
        return $rules;
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'login.min' => 'The minimum login length is 3 symbols',
            'email.unique' => 'This email already exists',
        ];
    }
}
