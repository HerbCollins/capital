<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request
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
            'email' => 'required|email|unique:users',
            'name' => 'required|unique:users',
            'phone' => 'required|min:11|max:13|unique:users'
        ];
    }

    public function messages()
    {
        return [
            'email.required'=>'请输入邮箱',
            'email.email'=>'请输入正确的邮箱',
            'email.unique'=>'邮箱已存在',
            'name.required' => '请输入姓名',
            'name.unique' => '名称已存在',
            'phone.required'=>'请输入手机号',
            'phone.unique' => '手机号已存在',
            'phone.min' => '请输入11位手机号码',
        ];
    }
}
