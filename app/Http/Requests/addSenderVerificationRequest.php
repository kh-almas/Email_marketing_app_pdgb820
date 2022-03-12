<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addSenderVerificationRequest extends FormRequest
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
            'nickname' => 'required|max:100',
            'from_email' => 'required|max:256',
            'from_name' => 'required|max:256',
            'reply_to' => 'required|max:256',
            'reply_to_name' => 'required|max:256',
            'address' => 'required|max:100',
            'address2' => 'nullable|max:100',
            'state' => 'required|max:2',
            'city' => 'required|max:150',
            'country' => 'required|max:100',
            'zip' => 'required|max:10',
        ];
    }

    public function messages()
    {
        return [
            'nickname.required' => 'Nickname is required and should be under 100 characters',
            'nickname.max' => 'Nickname is required and should be under 100 characters',
            'from_email.required' => 'Email is required and should be under 256 characters',
            'from_email.max' => 'Email is required and should be under 256 characters',
            'from_name.required' => 'Name is required and should be under 256 characters',
            'from_name.max' => 'Name is required and should be under 256 characters',
            'reply_to.required' => 'Email is required and should be under 256 characters',
            'reply_to.max' => 'Email is required and should be under 256 characters',
            'reply_to_name.required' => 'Name is required and should be under 256 characters',
            'reply_to_name.max' => 'Name is required and should be under 256 characters',
            'address.required' => 'Address is required and should be under 100 characters',
            'address.max' => 'Address is required and should be under 100 characters',
            'address2.max' => 'Address2 should be under 100 characters',
            'state.required' => 'State is required and should be under 2 characters',
            'state.max' => 'State is required and should be under 2 characters',
            'city.required' => 'City is required and should be under 150 characters',
            'city.max' => 'City is required and should be under 150 characters',
            'country.required' => 'Country is required and should be under 100 characters',
            'country.max' => 'Country is required and should be under 100 characters',
            'zip.required' => 'ZIP is required and should be under 10 characters',
            'zip.max' => 'ZIP is required and should be under 10 characters',
        ];
    }
}
