<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SlideAdd extends FormRequest
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
            'sl_ten' => 'required|unique:slide|max:255',
            'image' => 'required',
            'desc' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'sl_ten.required' => 'Vui lòng không để trống mục tên của Slide.',
            'sl_ten.unique' => 'Tên Slide đã được sử dụng, vui lòng chọn một tên khác.',
            'image.required' => 'Vui lòng không để trống mục hình ảnh của Slide.',
            'desc.required' => 'Vui lòng không để trống mục mô tả của Slide.',
        ];
    }
}
