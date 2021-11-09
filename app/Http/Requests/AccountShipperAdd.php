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
            'password' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng không để trống mục họ và tên.',
            'gh_email.required' => 'Vui lòng không để trống mục email.',
            'gh_email.unique' => 'Tài khoản email đã được sử dụng.',
            'password.required' => 'Vui lòng không để trống mục mật khẩu.',
        ];
    }
}
