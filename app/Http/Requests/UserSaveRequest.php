<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserSaveRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'                => 'required',
            'surname'             => 'required',
            'mobile_number'       => 'required',
            'email'               => 'required_if:user_id,null|email|unique:users,email,' .$this->user_id,
            'password'            => 'required_if:user_id,null||required_with:password_confirmation|same:password_confirmation',
            'dob'                 => 'required',
            'language'            => 'required',
            'south_african_id_no' => 'required',
            'interest_name'       => 'required',
        ];
    }
}
