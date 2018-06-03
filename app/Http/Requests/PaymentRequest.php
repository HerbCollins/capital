<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PaymentRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'pwd' => 'required|max:6|min:6|numeric'
        ];
    }

    public function messages()
    {
        return [
            'pwd:required' => '请输入密码',
            'pwd:max' => '请输入6位数字',
            'pwd:min' => '请输入6位数字',
            'pwd:numeric' => '请输入6位数字'
        ];
    }
}
