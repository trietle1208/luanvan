<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountUpdate extends FormRequest
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
            'address' =>'required',
            'phone' =>'required|numeric',
            'age' =>'required|before: 18 years ago',
        ];
    }
    public function messages()
    {
        return [
            'address.required' =>'Vui lòng không để trống mục địa chỉ.',
            'phone.required' =>'Vui lòng không để trống mục số điện thoại.',
            'phone.numeric' =>'Số điện thoại nhập vào phải là kiểu số.',
            'age.required' =>'Vui lòng không để trống mục ngày sinh.',
            'age.before' =>'Bạn phải đủ 18 tuổi.',
        ];
    }
}
