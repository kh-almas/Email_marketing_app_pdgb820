<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateemailListRequest extends FormRequest
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
            'name' => 'required|max:200',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'List Title is requires',
            'name.max' => 'Email should under 200 characters',
        ];
    }
}
