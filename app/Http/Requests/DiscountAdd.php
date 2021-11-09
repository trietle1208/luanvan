<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountAdd extends FormRequest
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
            'desc' => 'required',
            'type' => 'required',
            'price' => 'required|numeric',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng không để trống mục tên của khuyến mãi.',
            'desc.required' => 'Vui lòng không để trống mục mô tả của khuyến mãi.',
            'type.required' => 'Vui lòng chọn hình thức cho khuyến mãi.',
            'price.required' => 'Vui lòng không để trống mục số tiền giảm của khuyến mãi.',
            'price.numeric' => 'Số tiền giảm của khuyến mãi phải là kiểu số.',
            'status.required' => 'Vui lòng không để trống mục số lượng của khuyến mãi.',
        ];
    }
}
