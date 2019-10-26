<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogCategoryUpdateRequest extends FormRequest
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
            'title' => 'required|min:4|max:200',
            'slug' => 'max:200',
            'description' => 'min:3|string|max:500',
            'parent_id' => 'integer',
        ];
    }

    public function messages()
    {
        return [
            'title.min' => 'The minimal name length is 4 symbols',
            'description.min' => 'The minimal description length is 5 symbols',
            'description.string' => 'Description must be text'
        ];
    }
}