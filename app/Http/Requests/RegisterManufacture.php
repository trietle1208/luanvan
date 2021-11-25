<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterManufacture extends FormRequest
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
            'address' => 'required',
            'phone' => 'required|numeric',
            'desc' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng không để trống mục tên của nhà cung cấp.',
            'address.required' => 'Vui lòng không để trống mục địa chỉ.',
            'phone.required' => 'Vui lòng không để trống mục số điện thoại.',
            'phone.numeric' => 'Số điện thoại phải là kiểu số.',
            'desc.required' => 'Vui lòng không để trống mục mô tả.',
        ];
    }
}
