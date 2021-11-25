<?php

namespace App\Http\Controllers\NCC;

use App\Http\Controllers\Controller;
use App\Http\Requests\VoucherAdd;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class VoucherController extends Controller
{
    private $voucher;
    public function __construct(Voucher $voucher) {
        $this->voucher = $voucher;
        $this->middleware(['permission:Thêm mã giảm giá'])->only(['create']);
        $this->middleware(['permission:Chỉnh sửa mã giảm giá'])->only(['edit']);
        $this->middleware(['permission:Xóa mã giảm giá'])->only(['delete']);
    }

    public function index() {
            $vouchers = $this->voucher->where('ncc_id',Auth::user()->ncc->ncc_id)->latest()->paginate(5);
        return view('admin.nhacungcap.voucher.index',compact('vouchers'));
    }

    public function create() {

        return view('admin.nhacungcap.voucher.create');

    }

    public function store(VoucherAdd $request) {
        $data = [
            'mgg_ten' => $request->name,
            'mgg_macode' => $request->mgg_macode,
            'mgg_dieukien' => $request->condition,
            'mgg_mota' => $request->desc,
            'mgg_hinhthuc' => $request->type,
            'mgg_sotiengiam' => $request->price,
            'mgg_soluong' => $request->qty,
            'ncc_id' => Auth::user()->ncc->ncc_id,
        ];

        $this->voucher->create($data);

        Session::put('message','Thêm mã giảm giá thành công !!!');
        return redirect()->route('sup.voucher.create');
    }

    public function edit($id) {
        $voucher = $this->voucher->where('mgg_id',$id)->first();
        return view('admin.nhacungcap.voucher.edit',compact('voucher'));
    }
}
