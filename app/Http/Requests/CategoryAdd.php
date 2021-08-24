<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryAdd extends FormRequest
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
            'dm_ten' => 'required|unique:danhmuc|max:255',
            'desc' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'dm_ten.required' => 'Vui lòng không để trống mục tên của danh mục.',
            'dm_ten.unique' => 'Tên danh mục đã được sử dụng, vui lòng chọn một tên khác.',
            'desc.required' => 'Vui lòng không để trống mục mô tả của danh mục.',
        ];
    }
}
