<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParaAdd extends FormRequest
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
            'parent' => 'required'

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng không để trống mục tên của thông số sản phẩm.',
            'parent.required' => 'Vui lòng chọn loại cho thông số'

        ];
    }
}
