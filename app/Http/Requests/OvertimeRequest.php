<?php

namespace App\Http\Requests;

use App\Http\Requests\Api\FormRequestApi;

class OvertimeRequest extends FormRequestApi
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
        //dd($this->input('member_ids'));
        return [
            'member_ids' => 'required|array',
            'member_ids.*' => 'uuid|exists:users,id|distinct',
            'from' => 'required|date_format:Y-m-d H:i:s',
            'to' => 'required|date_format:Y-m-d H:i:s',
            'approval_id' => 'required|uuid|exists:users,id',
            'reason' => 'required'
        ];
    }
}
