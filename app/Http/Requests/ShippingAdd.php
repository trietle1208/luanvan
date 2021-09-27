<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingAdd extends FormRequest
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
            'image' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng không để trống mục tên của hình thức.',
            'image.required' => 'Vui lòng không để trống mục hình ảnh của hình thức.',
        ];
    }
}
