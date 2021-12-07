<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Receipt;
use App\Models\ReceiptDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceiptController extends Controller
{
    public function __construct(Receipt $receipt, ReceiptDetail $receiptDetail, Product $product) {
        $this->receipt = $receipt;
        $this->receiptDetail = $receiptDetail;
        $this->product = $product;
    }
    public function index() {
        $receipts = $this->receipt->all();
        return view('admin.manager.receipt.index',compact('receipts'));
    }

    public function changeStatus(Request $request) {
        if($request->id) {
            $receipt = $this->receipt->find($request->id)->update([
                'pnh_trangthai' => 1,
                'pnh_ngayduyet' => Carbon::now(),
                'nguoiduyet_id' => Auth::id(),
            ]);
            $receiptDetails = $this->receiptDetail->where('pnh_id',$request->id)->get();
            foreach ($receiptDetails as $receiptDetail) {
                $product = $this->product->find($receiptDetail->sp_id);
                $product->update([
                    'sp_trangthai' => 1,
                ]);
            }
            return response()->json([
                'code' => 200,
                'message' => 'success',
            ], 200);
        }
    }
}
