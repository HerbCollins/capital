<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MinerRequest extends Request
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
            'title' => 'required|max:255|unique:miners',
            'price' => 'required',
            'max' => 'required',
            'day_max' => 'required',
            'exist_max' => 'required',
            'income' => 'required',
            'timelong' => 'required',
            'cycle' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '请输入标题',
            'title.max' => '标题最长不超过255个字符',
            'title.unique' => '标题已存在',
            'max.required' => '请输入标题',
            'day_max.required' => '请输入标题',
            'exist_max.required' => '请输入标题',
            'income.required' => '请输入标题',
            'timelong.required' => '请输入标题',
            'cycle.required' => '请输入标题',
        ];
    }
}
