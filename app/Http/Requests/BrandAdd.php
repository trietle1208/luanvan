<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandAdd extends FormRequest
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
            'th_ten' => 'required|unique:thuonghieu|max:255',
            'image' => 'required',
            'desc' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'th_ten.required' => 'Vui lòng không để trống mục tên của thương hiệu.',
            'th_ten.unique' => 'Tên thương hiệu đã được sử dụng, vui lòng chọn một tên khác.',
            'image.required' => 'Vui lòng không để trống mục hình ảnh của thương hiệu.',
            'desc.required' => 'Vui lòng không để trống mục mô tả của thương hiệu.',
        ];
    }
}
