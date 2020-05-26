<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Api\FormRequestApi;

class LoginRequest extends FormRequestApi
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
            'email'     => 'required|email|min:6|max:100',
            'password'  => 'required|min:3|max:100'
        ];
    }
}
