<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addEmailRequest extends FormRequest
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
            'first_name' => 'nullable|max:50',
            'last_name' => 'nullable|max:50',
            'email' => 'required|max:200|unique:emails',
            'address_line_one' => 'nullable|max:200',
            'address_line_two' => 'nullable|max:200',
            'city' => 'nullable|max:50',
            'state' => 'nullable|max:50',
            'postal_code' => 'nullable|max:50',
            'country' => 'nullable|max:50',
            'phone_number' => 'nullable|max:20',
            'whatsapp' => 'nullable|max:20',
            'facebook' => 'nullable|max:150',

            'line' => 'nullable|max:150',
            'alternate_emails' => 'nullable|max:200',
            'list_ids' => 'required|max:240',
            'unique_name' => 'nullable|max:50',
            'sendgrid_id' => 'nullable|max:240',
            'sendgrid_metadata' => 'nullable|max:250',
        ];
    }

    public function messages()
    {
        return [
            'first_name.max' => 'First name should under 50 characters',
            'last_name.max' => 'Last name should under 50 characters',
            'email.required' => 'Email is requires',
            'email.unique' => 'Email should be unique',
            'email.max' => 'Email should under 50 characters',
            'address_line_one.max' => 'Address line one should under 50 characters',
            'address_line_two.max' => 'Address line two should under 50 characters',
            'city.max' => 'City should under 50 characters',
            'state.max' => 'State should under 50 characters',
            'postal_code.max' => 'Postal code should under 50 characters',
            'country.max' => 'Country should under 50 characters',
            'phone_number.max' => 'Phone number should under 50 characters',
            'whatsapp.max' => 'Whatsapp should under 50 characters',
            'facebook.max' => 'Facebook should under 50 characters',
            'line.max' => 'Line should under 150 characters',
            'alternate_emails.max' => 'Facebook should under 200 characters',
            'list_ids.max' => 'List Ids should under 240 characters',
            'list_ids.required' => 'List Ids is requires',
            'unique_name.max' => 'Unique Name should under 50 characters',
            'sendgrid_id.max' => 'Sendgrid Id should under 240 characters',
            'sendgrid_metadata.max' => 'Sendgrid Metadata should under 250 characters',
        ];
    }
}
