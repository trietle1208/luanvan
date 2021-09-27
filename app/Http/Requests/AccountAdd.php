<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountAdd extends FormRequest
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
            'sex' => 'required',
            'address' => 'required',
            'phone' => 'required|number',
            'age' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'sex.required' => 'Vui lòng không để trống mục giới tính.',
            'address.unique' => 'Vui lòng không để trống mục địa chỉ.',
            'phone.required' => 'Vui lòng không để trống mục số điện thoại.',
            'phone.number' => 'Số điện thoại phải là số.',
            'age.required' => 'Vui lòng không để trống mục số ngày sinh.',
        ];
    }
}
