<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MissingRequest extends FormRequest
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
           'screen_shot' => 'required',
           'targetsystem_list' => 'required',
           'targetserver_list' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'requested_date.required' => 'This field is required',
            'screen_shot.required' => 'This field is required',
            'targetsystem_list.required' => 'This field is required',
            'targetserver_list.required' => 'This field is required'
        ];
    }
}
