<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReceiptAdd extends FormRequest
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
            'name' => 'required|max:255',
            'sum' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng không để trống mục tên của phiếu nhập.',
            'sum.required' => 'Vui lòng không để trống mục tổng tiền của phiếu nhập.',
            'sum.numeric' => 'Số tiền giảm của phiếu nhập phải là kiểu số.',
        ];
    }
}
