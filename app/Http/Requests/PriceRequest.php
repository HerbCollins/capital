<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PriceRequest extends Request
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
            'price' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'price.required' => '请输入价格',
            'price.numeric' => '价格必须是个数值'
        ];
    }
}
