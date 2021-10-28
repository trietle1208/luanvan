<?php

namespace App\Http\Controllers\NCC;

use App\Http\Controllers\Controller;
use App\Models\OrderNCC;
use App\Models\Receipt;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SalesStatisticalController extends Controller
{
    public function index()
    {   
        $sum_voucher = 0;
        $sum_discount = 0;

        $receipt = Receipt::where('ncc_id',Auth::user()->ncc_id)->get();
        $total_receipt = $receipt->where('pnh_trangthai',1)->sum('pnh_tongcong');
        
        $order = OrderNCC::where('ncc_id',Auth::user()->ncc_id)->get();
        $total_order = $order->WhereIn('trangthai',[4,5])->sum('tongtien');

        $total_sales = $total_order - $total_receipt;
        $percent_sales = $total_order/$total_receipt;
        
        $total = [
            'total_receipt' => $total_receipt,
            'total_order' => $total_order,
            'total_sales' => $total_sales,
            'percent_sales' => $percent_sales,
        ];

        $discount =  OrderNCC::where('ncc_id',Auth::user()->ncc_id)->with(['voucher'])->get();
        
        foreach ($discount as $item){
            if($item['voucher']){
                if($item['voucher']['mgg_hinhthuc'] == 0)
                {
                    $sum_voucher += $item['voucher']['mgg_sotiengiam'];
                }
                else
                {
                    $sum_voucher +=  $item['tongtien']*$item['voucher']['mgg_sotiengiam'];
                }
            }
        }
        
        return view('admin.nhacungcap.statistical.sales.index',$total);
    }
}
