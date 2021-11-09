<?php

namespace App\Http\Controllers\NCC;

use App\Http\Controllers\Controller;
use App\Http\Requests\DiscountAdd;
use App\Models\Discount;
use App\Models\Product;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Brian2694\Toastr\Facades\Toastr;
class DiscountController extends Controller
{
    use StorageImageTrait;
    private $discount;
    private $product;
    private $htmlSelectType = '';
    private $htmlSelectStatus = '';
    public function __construct(Discount $discount, Product $product) {
        $this->discount = $discount;
        $this->product = $product;
        $this->middleware(['permission:Add Discount'])->only(['create']);
        $this->middleware(['permission:Edit Discount'])->only(['edit']);
        $this->middleware(['permission:Delete Discount'])->only(['delete']);
    }
    public function index() {
        $discounts = $this->discount->where('ncc_id',Auth::user()->ncc->ncc_id)->get();
        return view('admin.nhacungcap.discount.index',compact('discounts'));
    }

    public function create() {
        return view('admin.nhacungcap.discount.create');
    }

    public function store(DiscountAdd $request) {
        $dataCreate = [
            'km_ten' => $request->name,
            'km_mota' => $request->desc,
            'km_hinhthuc' => $request->type,
            'km_giamgia' => $request->price,
            'km_trangthai' => $request->status,
            'ncc_id' => Auth::user()->ncc->ncc_id,
        ];
        $dataUpload = $this->storageTraitUpload($request, 'image', 'discount');
        if(!empty($dataUpload)) {
            $dataCreate['km_hinhanh'] = $dataUpload['file_path'];
        }

        $this->discount->create($dataCreate);

        Toastr::success('Thêm khuyến mãi thành công!','Thành công');
        return redirect()->route('sup.discount.create');
    }

    public function edit($id) {
        $discounts = $this->discount->find($id);

        if($discounts->km_hinhthuc == 0) {
            $this->htmlSelectType .= '<option selected value="0">Giảm theo giá tiền</option>
                            <option value="1">Giảm theo %</option>';
        }
        else
        {
            $this->htmlSelectType .= '<option value="0">Giảm theo giá tiền</option>
                            <option selected value="1">Giảm theo %</option>';
        }

        if($discounts->km_trangthai == 0) {
            $this->htmlSelectStatus .= '<option selected value="0">Tắt</option>
                            <option value="1">Hiển thị</option>';
        }
        else
        {
            $this->htmlSelectStatus .= '<option  value="0">Tắt</option>
                            <option selected value="1">Hiển thị</option>';
        }

        $htmlType = $this->htmlSelectType;
        $htmlStatus = $this->htmlSelectStatus;

        return view('admin.nhacungcap.discount.edit',compact('discounts','htmlType','htmlStatus'));
    }

    public function update($id, DiscountAdd $request) {
        $dataUpdate = [
            'km_ten' => $request->name,
            'km_mota' => $request->desc,
            'km_hinhthuc' => $request->type,
            'km_giamgia' => $request->price,
            'km_trangthai' => $request->status,
            'ncc_id' => Auth::user()->ncc->ncc_id,
        ];

        $dataUpload = $this->storageTraitUpload($request, 'image', 'discount');
        if(!empty($dataUpload)) {
            $dataUpdate['km_hinhanh'] = $dataUpload['file_path'];
        }

        $this->discount->find($id)->update($dataUpdate);

        Toastr::success('Cập nhật khuyến mãi thành công!','Thành công');
        return redirect()->route('sup.discount.list');
    }

    public function delete($id) {
        $discount = $this->discount->find($id);
        foreach ($discount->product as $product) {
            $product->update([
               'km_id' => null,
            ]);
        }
        $discount->delete();
        return response()->json([
            'code' => 200,
            'message' => 'success',
        ], 200);
    }

    public function modalAjax(Request $request) {
        $products = Product::where('ncc_id',Auth::user()->ncc->ncc_id)->where('km_id','=',null)->get();
        $discount = $this->discount->find($request->id);
        return view('admin.nhacungcap.discount.sanpham',compact('products','discount'))->render();
    }

    public function addProduct(Request $request) {
        if($request->idProduct && $request->idDiscount){
            $discount = Discount::find($request->idDiscount);
            $productUp = $this->product->find($request->idProduct)->update([
               'km_id' => $request->idDiscount,
            ]);
            $product = $this->product->find($request->idProduct);
            $output = '<tr>
                        <td>
                            '.$product->sp_id.'
                        </td>
                        <td>
                            '.$product->sp_ten.'
                        </td>
                        <td>
                            <img src="'.$product->sp_hinhanh.'" style="height: 150px; width: 200px">
                        </td>
                        <td>
                            <a href="" data-id="'.$product->sp_id.'" data-key="'.$discount->km_id.'" class="btn btn-danger deleteProduct-discount">Xóa</a>
                        </td>
                    </tr>';
            return response()->json([
                'code' => 200,
                'message' => 'Thêm khuyến mãi cho sản phẩm thành công!',
                'output' => $output,
            ], 200);
        }
    }
    public function deleteProduct(Request $request) {
        if($request->idProduct && $request->idDiscount){
            $output = '';
            $discount = Discount::find($request->idDiscount);
            $productUp = $this->product->find($request->idProduct)->update([
                'km_id' => null,
            ]);
            $product = $this->product->find($request->idProduct);
            $output .= '<tr>
                        <td>
                            '.$product->sp_id.'
                        </td>
                        <td>
                            '.$product->sp_ten.'
                        </td>
                        <td>
                            <img src="'.$product->sp_hinhanh.'" style="height: 150px; width: 200px">
                        </td>
                        <td>
                            <a href="" data-id="'.$product->sp_id.'" data-key="'.$discount->km_id.'" class="btn btn-info add-discount">Thêm</a>
                        </td>
                    </tr>';
            return response()->json([
                'code' => 200,
                'message' => 'Xóa khuyến mãi cho sản phẩm thành công!',
                'output' => $output,
            ], 200);
        }
    }

    public function changeStatus(Request $request){
        if($request->type == 1){
            Discount::find($request->id)->update([
                'km_trangthai' => 0,
            ]);

            return response()->json([
                'code' => 200,
            ]);
        }else if($request->type == 0){
            Discount::find($request->id)->update([
                'km_trangthai' => 1,
            ]);

            return response()->json([
                'code' => 200,
            ]);
        }
    }
}
