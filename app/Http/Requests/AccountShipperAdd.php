<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountShipperAdd extends FormRequest
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
            'gh_email' => 'required|unique:shipper',
            'address' => 'required',
            'phone' => 'required|numeric',
            'date' => 'required|before: 18 years ago',
            'password' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng không để trống mục họ và tên.',
            'gh_email.required' => 'Vui lòng không để trống mục email.',
            'gh_email.unique' => 'Tài khoản email đã được sử dụng.',
            'address.required' => 'Vui lòng không để trống mục địa chỉ.',
            'phone.required' => 'Vui lòng không để trống mục số điện thoại.',
            'phone.numeric' => 'Mục số điện thoại phải là kiểu số.',
            'date.required' => 'Vui lòng không để trống mục ngày sinh.',
            'date.before' => 'Bạn phải đủ 18 tuổi.',
            'password.required' => 'Vui lòng không để trống mục mật khẩu.',
        ];
    }
}
