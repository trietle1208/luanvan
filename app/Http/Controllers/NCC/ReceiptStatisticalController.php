<?php

namespace App\Http\Controllers\NCC;

use App\Http\Controllers\Controller;
use App\Models\OrderNCC;
use App\Models\Receipt;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReceiptStatisticalController extends Controller
{
    //Thống kê phiếu nhập hàng
    public function index(){
        //Thống kê tình trạng phiếu nhập
        $arr_count_receipt = [];
        $arr_name_receipt = [];
        $arr_color_receipt = [];
        $count_receipt = Receipt::where('ncc_id',Auth::user()->ncc_id)
                         ->select(DB::raw('count(*) count, pnh_trangthai trangthai'))
                         ->groupBy('pnh_trangthai')
                         ->get();
        foreach ($count_receipt as $item) {
            switch ($item['trangthai']) {
                case '0':
                    $status = 'Chưa duyệt';
                    $color = '#f1556c';
                    break;
                default:
                    $status = 'Đã duyệt';
                    $color = '#1abc9c';
                    break;
            }
            $arr_count_receipt[] = (int)$item['count'];
            $arr_name_receipt[] = (string)$status;
            $arr_color_receipt[] = (string)$color;
        }

        //Thống kê chi phí nhập hàng
        $arr_count_total_receipt =[];
        $arr_name_total_receipt = ['Chi phí thấp','Chi phí trung bình','Chi phí cao','Chi phí rất cao'];
        $arr_color_total_receipt = ['#6c757d','#4a81d4','#9400D3','#1abc9c'];
        $count_small = 0;
        $count_medium = 0;
        $count_large = 0;
        $count_big = 0;

        
        $count_total_receipt_small = Receipt::where('ncc_id',Auth::user()->ncc_id)
                               ->select(DB::raw('count(*) count, pnh_tongcong tongtien'))
                               ->groupBy('tongtien')
                               ->havingRaw('tongtien BETWEEN 0 AND 15000000')
                               ->get();

        $count_total_receipt_medium = Receipt::where('ncc_id',Auth::user()->ncc_id)
                               ->select(DB::raw('count(*) count, pnh_tongcong tongtien'))
                               ->groupBy('tongtien')
                               ->havingRaw('tongtien BETWEEN 15000000 AND 45000000')
                               ->get();

        $count_total_receipt_large = Receipt::where('ncc_id',Auth::user()->ncc_id)
                               ->select(DB::raw('count(*) count, pnh_tongcong tongtien'))
                               ->groupBy('tongtien')
                               ->havingRaw('tongtien BETWEEN 45000000 AND 80000000')
                               ->get();

        $count_total_receipt_big = Receipt::where('ncc_id',Auth::user()->ncc_id)
                               ->select(DB::raw('count(*) count, pnh_tongcong tongtien'))
                               ->groupBy('tongtien')
                               ->having('tongtien','>=',80000000)
                               ->get();

        if($count_total_receipt_small){
        foreach ($count_total_receipt_small as $item){
            $count_small += (int)$item['count'];
        }
        $arr_count_total_receipt[0] = $count_small;
        }else{
            $arr_count_total_receipt[0] = 0;
        }

        if($count_total_receipt_medium){
            foreach ($count_total_receipt_medium as $item){
                $count_medium += (int)$item['count'];
            }
            $arr_count_total_receipt[1] = $count_medium;
        }else{
            $arr_count_total_receipt[1] = 0;
        }

        if($count_total_receipt_large){
            foreach ($count_total_receipt_large as $item){
                $count_large += (int)$item['count'];
            }
            $arr_count_total_receipt[2] = $count_large;
        }else{
            $arr_count_total_receipt[2] = 0;
        }
        
        if($count_total_receipt_big){
            foreach ($count_total_receipt_big as $item){
                $count_big += (int)$item['count'];
            }
            $arr_count_total_receipt[3] = $count_big;
        }else{
            $arr_count_total_receipt[3] = 0;
        }


        //Thống kê phiếu nhập theo tất cả Tháng
        $arr_month = [1,2,3,4,5,6,7,8,9,10,11,12];
        $arr_count_receipt_success = [];
        $arr_count_receipt_delete = [];
        $arr_count_total_receipt_success = [];
        $arr_count_total_receipt_delete = [];
        $count_receipt_by_month_success = Receipt::where('ncc_id',Auth::user()->ncc_id)
                                            ->select(DB::raw('count(*) count, pnh_trangthai trangthai, MONTH(created_at) month, SUM(pnh_tongcong) tongtien'))
                                            ->groupBy('pnh_trangthai','month')
                                            ->having('pnh_trangthai',1)
                                            ->get();

        $count_receipt_by_month_delete = Receipt::where('ncc_id',Auth::user()->ncc_id)
                                            ->select(DB::raw('count(*) count, pnh_trangthai trangthai, MONTH(created_at) month, SUM(pnh_tongcong) tongtien'))
                                            ->groupBy('pnh_trangthai','month')
                                            ->having('pnh_trangthai',0)
                                            ->get();
        
        foreach($arr_month as $month) {
            $count = 0;
            $total = 0;
            foreach($count_receipt_by_month_success as $item){
                if($item['month'] == $month){
                    $count = (int)$item['count'];
                    $total = (int)$item['tongtien'];
                    break;
                }
            }
            $arr_count_receipt_success[] = $count;
            $arr_count_total_receipt_success[] = $total;
        }

        foreach($arr_month as $month) {
            $count = 0;
            $total = 0;
            foreach($count_receipt_by_month_delete as $item){
                if($item['month'] == $month){
                    $count = (int)$item['count'];
                    $total = (int)$item['tongtien'];
                    break;
                }
            }
            $arr_count_receipt_delete[] = $count;
            $arr_count_total_receipt_delete[] = $total;
        }

        $arr_receipt = [
            'arr_count_receipt' => json_encode($arr_count_receipt),
            'arr_name_receipt' => json_encode($arr_name_receipt),
            'arr_color_receipt' => json_encode($arr_color_receipt),
            'arr_name_total_receipt' => json_encode($arr_name_total_receipt),
            'arr_color_total_receipt' => json_encode($arr_color_total_receipt),
            'arr_count_total_receipt' => json_encode($arr_count_total_receipt),
            'arr_count_receipt_success' => json_encode($arr_count_receipt_success),
            'arr_count_receipt_delete' => json_encode($arr_count_receipt_delete),
            'arr_count_total_receipt_success' => json_encode($arr_count_total_receipt_success),
        ];

        return view('admin.nhacungcap.statistical.receipt.index',$arr_receipt);
    }

    //Thống kê phiếu nhập theo từng Tháng
    public function fillReceiptByMonth(Request $request){

        $year = Carbon::parse($request->month)->format('Y');
        $month = Carbon::parse($request->month)->format('m');
        $arr_count_receipt_success = [];
        $arr_count_receipt_delete = [];
        $arr_count_receipt_total_success = [];
        $arr_month_receipt = [];
        $arrDay = [];
        $count_success = 0;
        $total_receipt = 0;
        $count_delete = 0;

        $count_receipt = Receipt::where('ncc_id',Auth::user()->ncc_id)
                                    ->select(DB::raw('count(*) count, pnh_trangthai trangthai, SUM(pnh_tongcong) tongtien'))
                                    ->whereMonth('created_at','=',$month)
                                    ->groupBy('trangthai')
                                    ->get();

        foreach ($count_receipt as $item){
            if($item['trangthai'] == 0){
                $count_delete += $item['count'];
            }
            else if($item['trangthai'] == 1)
            {
                $count_success += $item['count'];
                $total_receipt += $item['tongtien'];
            }
        }

        $count_receipt_success = Receipt::where('ncc_id',Auth::user()->ncc_id)
                                    ->select(DB::raw('count(*) count, pnh_trangthai trangthai, SUM(pnh_tongcong) tongtien, DATE(created_at) day'))
                                    ->whereMonth('created_at','=',$month)
                                    ->groupBy('trangthai','day')
                                    ->having('trangthai',1)
                                    ->get();

        $count_receipt_delete = Receipt::where('ncc_id',Auth::user()->ncc_id)
                                    ->select(DB::raw('count(*) count, pnh_trangthai trangthai, SUM(pnh_tongcong) tongtien, DATE(created_at) day'))
                                    ->whereMonth('created_at','=',$month)
                                    ->groupBy('trangthai','day')
                                    ->having('trangthai',0)
                                    ->get();
    
        for($day = 1 ; $day <= 31; $day++){
            $time = mktime(12,0,0, $month, $day, $year);
            if(date('m',$time) == $month){
                $arrDay[] = date('Y-m-d',$time);
            }
        }

        foreach($arrDay as $day) {
            $count = 0;
            foreach($count_receipt_delete as $item){
                if($item['day'] == $day){
                    $count = $item['count'];
                    break;
                }
            }
            $arr_count_receipt_delete[] = $count;
        }

        foreach($arrDay as $day) {
            $count = 0;
            $total = 0;
            foreach($count_receipt_success as $item){
                if($item['day'] == $day){
                    $count = $item['count'];
                    $total = $item['tongtien'];
                    break;
                }
            }
            $arr_count_receipt_success[] = $count;
            $arr_count_receipt_total_success[] = $total;
        }

        $arr_month_receipt = 
        [
            'arr_count_receipt_success' => json_encode($arr_count_receipt_success),
            'arr_count_receipt_delete' => json_encode($arr_count_receipt_delete),
            'arr_count_receipt_total_success' => json_encode($arr_count_receipt_total_success),
            'arrDay' => json_encode($arrDay),
        ];


        return response()->json([
            'code' => 200,
            'output' => $arr_month_receipt,
            'count_success' => $count_success,
            'count_delete' => $count_delete,
            'total_receipt' => number_format($total_receipt),
        ]);
    }

    //Thống kê phiếu nhập theo từng Quý
    public function fillReceiptBy3Month(Request $request){
        $arr_count_receipt_success = [];
        $arr_count_receipt_delete = [];
        $arr_count_total_receipt = [];
        $count_success = 0;
        $count_delete = 0;
        $total_receipt =0;
        $arrDayStart = [];
        $arrDayEnd = [];
        $arrMonth =[];
        $arrMonthNumber=[];
        $month_start = '';
        $month_end = '';
        $year = $request->year;

        if($request->type == 1){
            for($day = 1 ; $day <= 31; $day++){
                $time = mktime(12,0,0, 1, $day, $year);
                if(date('m',$time) == 1){
                    $arrDayStart[] = date('Y-m-d',$time);
                }
            }
            for($day = 1 ; $day <= 31; $day++){
                $time = mktime(12,0,0, 3, $day, $year);
                if(date('m',$time) == 3){
                    $arrDayEnd[] = date('Y-m-d',$time);
                }
            }
            
            $month_start = reset($arrDayStart);
            $month_end = end($arrDayEnd);
            $arrMonth =['Tháng 1','Tháng 2','Tháng 3'];
            $arrMonthNumber=[1,2,3];
        }
        else if($request->type == 2){
            for($day = 1 ; $day <= 31; $day++){
                $time = mktime(12,0,0, 4, $day, $year);
                if(date('m',$time) == 4){
                    $arrDayStart[] = date('Y-m-d',$time);
                }
            }
            for($day = 1 ; $day <= 31; $day++){
                $time = mktime(12,0,0, 6, $day, $year);
                if(date('m',$time) == 6){
                    $arrDayEnd[] = date('Y-m-d',$time);
                }
            }
            $month_start = reset($arrDayStart);
            $month_end = end($arrDayEnd);
            $arrMonth =['Tháng 4','Tháng 5','Tháng 6'];
            $arrMonthNumber=[4,5,6];
        }
        else if($request->type == 3){
            for($day = 1 ; $day <= 31; $day++){
                $time = mktime(12,0,0, 7, $day, $year);
                if(date('m',$time) == 7){
                    $arrDayStart[] = date('Y-m-d',$time);
                }
            }
            for($day = 1 ; $day <= 31; $day++){
                $time = mktime(12,0,0, 9, $day, $year);
                if(date('m',$time) == 9){
                    $arrDayEnd[] = date('Y-m-d',$time);
                }
            }
            $month_start = reset($arrDayStart);
            $month_end = end($arrDayEnd);
            $arrMonth =['Tháng 7','Tháng 8','Tháng 9'];
            $arrMonthNumber=[7,8,9];
        }
        else{
            for($day = 1 ; $day <= 31; $day++){
                $time = mktime(12,0,0, 10, $day, $year);
                if(date('m',$time) == 10){
                    $arrDayStart[] = date('Y-m-d',$time);
                }
            }
            for($day = 1 ; $day <= 31; $day++){
                $time = mktime(12,0,0, 12, $day, $year);
                if(date('m',$time) == 12){
                    $arrDayEnd[] = date('Y-m-d',$time);
                }
            }
            $month_start = reset($arrDayStart);
            $month_end = end($arrDayEnd);
            $arrMonth =['Tháng 10','Tháng 11','Tháng 12'];
            $arrMonthNumber=[10,11,12];
        }

        $count_receipt = Receipt::where('ncc_id',Auth::user()->ncc_id)
        ->select(DB::raw('count(*) as count, pnh_trangthai trangthai, MONTH(created_at) month, SUM(pnh_tongcong) tongtien'))
        ->whereBetween('created_at',[$month_start,$month_end])
        ->groupBy('trangthai','month')
        ->get();

        $count_receipt_success = Receipt::where('ncc_id',Auth::user()->ncc_id)
        ->select(DB::raw('count(*) as count, pnh_trangthai trangthai, MONTH(created_at) month, SUM(pnh_tongcong) tongtien'))
        ->whereBetween('created_at',[$month_start,$month_end])
        ->groupBy('trangthai','month')
        ->having('trangthai',1)
        ->get();

        $count_receipt_delete = Receipt::where('ncc_id',Auth::user()->ncc_id)
        ->select(DB::raw('count(*) as count, pnh_trangthai trangthai, MONTH(created_at) month, SUM(pnh_tongcong) tongtien'))
        ->whereBetween('created_at',[$month_start,$month_end])
        ->groupBy('trangthai','month')
        ->having('trangthai',0)
        ->get();

        foreach ($count_receipt as $item){
            if($item['trangthai'] == 0){
                $count_delete = $item['count'];
            }
            else if($item['trangthai'] == 1)
            {
                $count_success = $item['count'];
                $total_receipt = $item['tongtien'];
            }
        }

        foreach ($arrMonthNumber as $month){
            $count = 0;
            $total = 0;
            foreach ($count_receipt_success as $item){
                if($item['month'] == $month){
                    $count = $item['count'];
                    $total = $item['tongtien'];
                    break;
                }
            }
            $arr_count_receipt_success[] = $count;
            $arr_count_total_receipt[] = $total;
        }

        foreach ($arrMonthNumber as $month){
            $count = 0;
            foreach ($count_receipt_delete as $item){
                if($item['month'] == $month){
                    $count = $item['count'];
                    break;
                }
            }
            $arr_count_receipt_delete[] = $count;
        }

        $arr_month_order = [
            'arr_count_receipt_success' => json_encode($arr_count_receipt_success),
            'arr_count_receipt_delete' => json_encode($arr_count_receipt_delete),
            'arr_count_total_receipt' => json_encode($arr_count_total_receipt),
            'arrMonth' => json_encode($arrMonth),
        ];

        return response()->json([
            'code' => 200,
            'output' => $arr_month_order,
            'count_success' => $count_success,
            'count_delete' => $count_delete,
            'total_receipt' => number_format($total_receipt),
        ]);
    }
}
