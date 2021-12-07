<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoucherUpdate extends FormRequest
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
            'mgg_macode' => 'required|max:255',
            'condition'  => 'required|numeric',
            'desc' => 'required',
            'type' => 'required',
            'price' => 'required|numeric',
            'qty' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng không để trống mục tên của mã giảm giá.',
            'mgg_macode.required' => 'Vui lòng không để trống mục mã code của mã giảm giá.',
            'condition.required' => 'Vui lòng không để trống mục điều kiện của mã giảm giá.',
            'condition.numeric' => 'Điều kiện của  mã giảm giá phải là kiểu số.',
            'desc.required' => 'Vui lòng không để trống mục mô tả của mã giảm giá.',
            'type.required' => 'Vui lòng chọn hình thức cho mã giảm giá.',
            'price.required' => 'Vui lòng không để trống mục số tiền giảm của mã giảm giá.',
            'price.numeric' => 'Số tiền giảm của mã giảm giá phải là kiểu số.',
            'qty.required' => 'Vui lòng không để trống mục số lượng của mã giảm giá.',
            'qty.numeric' => 'Số lượng của mã giảm giá phải là kiểu số.',
        ];
    }
}
