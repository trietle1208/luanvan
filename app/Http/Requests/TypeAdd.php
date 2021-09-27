<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TypeAdd extends FormRequest
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
            'loaisp_ten' => 'required|unique:loaisanpham|max:255',
            'desc' => 'required',
            'parent' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'loaisp_ten.required' => 'Vui lòng không để trống mục tên của loại sản phẩm.',
            'loaisp_ten.unique' => 'Tên loại sản phẩm đã được sử dụng, vui lòng chọn một tên khác.',
            'desc.required' => 'Vui lòng không để trống mục mô tả của loại sản phẩm.',
            'parent.required' => 'Vui lòng chọn danh mục cho loại'
        ];
    }
}
