<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SapuserFunctionalRequest extends FormRequest
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
            'name' => 'required',
            'approved_date' => 'required|date',
            'status_list' => 'required',
            'user_list' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'This field is required',
            'approved_date.required' => 'This field is required',
            'status_list.required' => 'This field is required',
            'user_list.required' => 'This field is required'
        ];
    }
}
