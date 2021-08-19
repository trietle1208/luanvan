<?php

namespace App\Http\Controllers\NCC;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class DiscountController extends Controller
{
    use StorageImageTrait;
    private $discount;
    private $htmlSelectType = '';
    private $htmlSelectStatus = '';
    public function __construct(Discount $discount) {
        $this->discount = $discount;
    }
    public function index() {
        $discounts = $this->discount->where('ncc_id',Auth::user()->ncc->ncc_id)->get();
        return view('admin.nhacungcap.discount.index',compact('discounts'));
    }

    public function create() {
        return view('admin.nhacungcap.discount.create');
    }

    public function store(Request $request) {
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

        Session::put('message','Thêm chương trình khuyến mãi thành công !!!');
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

    public function update($id, Request $request) {
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

        Session::put('message','Cập nhật khuyến mãi thành công !!!');
        return redirect()->route('sup.discount.list');
    }
}
