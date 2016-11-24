<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SapuserRequest extends FormRequest
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
            'requested_date' => 'required|date',
            'sap_username' => 'required|min:3',
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:2',
            'email' => 'required|email|max:255',
            'tel_num' => 'required',
            'targetserver_list' => 'required',
            'user_role' => 'required'
        ];
    }

    public function messages()
    {
        return [
           'requested_date.required' => 'This field is required', 
           'sap_username.required' => 'This field is required', 
           'first_name.required' => 'This field is required', 
           'last_name.required' => 'This field is required', 
           'email.required' => 'This field is required', 
           'tel_num.required' => 'This field is required', 
           'targetserver_list.required' => 'This field is required', 
           'user_role.required' => 'This field is required'
        ];
    }
}
