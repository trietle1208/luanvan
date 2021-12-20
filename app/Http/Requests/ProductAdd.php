<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductAdd extends FormRequest
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
            'detail' => 'required',
            // 'price' => 'required|numeric',
            'insurance' => 'required|numeric',
            'cate' => 'required',
            'brand' => 'required',
            'type' => 'required',
            'chitietthongso' => 'required',
            'chitietthongso.*' => 'max:255',
            'thongso' => 'required',
            'thongso.*' => 'exists:thongso,ts_id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng không để trống mục tên của tên sản phẩm.',
            'desc.required' => 'Vui lòng không để trống mục mô tả của sản phẩm',
            'detail.required' => 'Vui lòng không để trống mục chi tiết của sản phẩm.',
            'insurance.required' => 'Vui lòng không để trống mục thời gian bảo hành của sản phẩm.',
            // 'price.required' => 'Vui lòng không để trống mục giá của sản phẩm.',
            'cate.required' => 'Vui lòng chọn danh mục cho sản phẩm.',
            'brand.required' => 'Vui lòng chọn thương hiệu cho sản phẩm.',
            'type.required' => 'Vui lòng chọn loại cho sản phẩm.',
            'insurance.numeric' => 'Thời gian bảo hành của sản phẩm nhập vào phải là kiểu số',
            // 'price.numeric' => 'Giá tiền của sản phẩm nhập vào phải là kiểu số.',
            'chitietthongso.required' => 'Vui lòng không để trống mục chi tiết thông số.',
            'chitietthongso.*.max' => 'Vui lòng nhập không vượt quá 255 kí tự.',
            'thongso.required' => 'Vui lòng không để trống mục thông số.',
            'thongso.*.exists' => 'Vui lòng kiểm tra lại ID.',
        ];
    }
}
