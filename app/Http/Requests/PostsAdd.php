<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostsAdd extends FormRequest
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
            'bv_ten' => 'required|max:255',
            'parent' => 'required',
            'desc' => 'required',
            'contentpost' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng không để trống mục tên của tên bài viết.',
            'desc.required' => 'Vui lòng không để trống mục tóm tắt của bài viết',
            'contentpost.required' => 'Vui lòng không để trống mục nội dung của bài viết.',
            'parent.required' => 'Vui lòng không để trống mục danh mục của bài viết.',
        ];
    }
}
