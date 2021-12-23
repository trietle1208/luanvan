<?php

namespace App\Http\Controllers\NCC;

use App\Http\Controllers\Controller;
use App\Models\OrderNCC;
use App\Models\Receipt;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SalesStatisticalController extends Controller
{
    public function index(){   
        $sum_voucher = 0;
        $sum_discount = 0;
        $total_receipt = 0;
        $total_order = 0;
        $receipt = Receipt::where('ncc_id',Auth::user()->ncc_id)->get();
        $total_receipt = $receipt->where('pnh_trangthai',1)->sum('pnh_tongcong');
        
        $order = OrderNCC::where('ncc_id',Auth::user()->ncc_id)->get();
        $total_order = $order->WhereIn('trangthai',[4,5])->sum('tongtien');
        // if(!$receipt->isEmpty() && !$total_receipt->isEmpty() && !$order->isEmpty() && !$total_order->isEmpty()){
            $total_sales = $total_order - $total_receipt;
            $percent_sales = $total_order/$total_receipt;
            
            $discount =  OrderNCC::where('ncc_id',Auth::user()->ncc_id)->with(['voucher'])->get();
            if(!$discount->isEmpty()){
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
            }
            $arr_month = [1,2,3,4,5,6,7,8,9,10,11,12];
            $arr_receipt = [];
            $arr_order = [];
            $arr_sales = [];
            $arr_total_once_receipt = Receipt::where('ncc_id',Auth::user()->ncc_id)->where('pnh_trangthai',1)    
                                    ->select(DB::raw('count(*) count , MONTH(created_at) month, SUM(pnh_tongcong) tongtien'))
                                    ->groupBy('month')
                                    ->get();
    
            $arr_total_once_order = OrderNCC::where('ncc_id',Auth::user()->ncc_id)->WhereIn('trangthai',[4,5])   
                                    ->select(DB::raw('count(*) count , MONTH(created_at) month, SUM(tongtien) tongtien'))
                                    ->groupBy('month')
                                    ->get();
    
            foreach ($arr_month as $month){
                $total = 0;
                $count = 0;
                foreach($arr_total_once_receipt as $item){
                    if($item['month'] == $month){
                        $total = $item['tongtien'];
                        $count = $item['count'];
                    }
                }
                $arr_receipt[] = $total;
            }
    
            foreach ($arr_month as $month){
                $total = 0;
                $count = 0;
                foreach($arr_total_once_order as $item){
                    if($item['month'] == $month){
                        $total = $item['tongtien'];
                        $count = $item['count'];
                    }
                }
                $arr_order[] = $total;
            }
    
            foreach ($arr_month as $month){
                $receipt = 0;
                $order = 0;
                $sales = 0;
                foreach($arr_total_once_receipt as $item){
                    if($item['month'] == $month){
                        $receipt = $item['tongtien'];
                    }
                }
                foreach($arr_total_once_order as $item){
                    if($item['month'] == $month){
                        $order = $item['tongtien'];
                    }
                }
                $sales = $order - $receipt;
                $arr_sales[] = $sales;
            }
    
            $total = [
                'total_receipt' => $total_receipt,
                'total_order' => $total_order,
                'total_sales' => $total_sales,
                'percent_sales' => $percent_sales,
                'arr_receipt' => json_encode($arr_receipt),
                'arr_order' => json_encode($arr_order),
                'arr_sales' => json_encode($arr_sales),
                'arr_month' => json_encode($arr_month),
            ];
            return view('admin.nhacungcap.statistical.sales.index',$total);
        
    }

    public function fillByMonth(Request $request){
        $year = Carbon::parse($request->month)->format('Y');
        $month = Carbon::parse($request->month)->format('m');

        $sum_receipt = 0;
        $sum_order = 0;
        $sum_sales = 0;

        $arr_receipt = [];
        $arr_order = [];
        $arr_sales = [];
        $arrDay = [];
        $receipt = Receipt::where('ncc_id',Auth::user()->ncc_id)->where('pnh_trangthai',1)
                            ->select(DB::raw('count(*) count, SUM(pnh_tongcong) tongtien, DATE(created_at) day'))
                            ->whereMonth('created_at','=',$month)
                            ->groupBy('day')
                            ->get();

        $order = OrderNCC::where('ncc_id',Auth::user()->ncc_id)->whereIn('trangthai',[4,5])
                            ->select(DB::raw('count(*) count, SUM(tongtien) tongtien, DATE(created_at) day'))
                            ->whereMonth('created_at','=',$month)
                            ->groupBy('day')
                            ->get();


        foreach ($receipt as $item){
            $sum_receipt += $item['tongtien'];
        }

        foreach ($order as $item){
            $sum_order += $item['tongtien'];
        }

        $sum_sales = $sum_order - $sum_receipt;

        for($day = 1 ; $day <= 31; $day++){
            $time = mktime(12,0,0, $month, $day, $year);
            if(date('m',$time) == $month){
                $arrDay[] = date('Y-m-d',$time);
            }
        }

        foreach($arrDay as $day) {
            $total_receipt = 0;
            $total_order = 0;
            $total_sales = 0;
            foreach($receipt as $item){
                if($item['day'] == $day){
                    $total_receipt = $item['tongtien'];
                    break;
                }
            }
            foreach($order as $item){
                if($item['day'] == $day){
                    $total_order = $item['tongtien'];
                    break;
                }
            }
            $total_sales = $total_order - $total_receipt;
            $arr_sales[] = $total_sales;
            $arr_order[] = $total_order;
            $arr_receipt[] = $total_receipt;
        }
        $arr_month_sales = [
            'arr_order' => JSON_ENCODE($arr_order),
            'arr_receipt' => JSON_ENCODE($arr_receipt),
            'arr_sales' => JSON_ENCODE($arr_sales),
            'arrDay' => JSON_ENCODE($arrDay),
        ];

        return response()->json([
            'code' => 200,
            'output' => $arr_month_sales,
            'sum_receipt' => number_format($sum_receipt),
            'sum_order' => number_format($sum_order),
            'sum_sales' => number_format($sum_sales),
        ]);
    }

    public function fillBy3Month(Request $request){
        $arr_receipt = [];
        $arr_order = [];
        $arr_sales = [];

        $sum_receipt = 0;
        $sum_order = 0;
        $sum_sales = 0;

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

        $receipt = Receipt::where('ncc_id',Auth::user()->ncc_id)->where('pnh_trangthai',1)
                            ->select(DB::raw('count(*) count, SUM(pnh_tongcong) tongtien, MONTH(created_at) month'))
                            ->whereBetween('created_at',[$month_start,$month_end])
                            ->groupBy('month')
                            ->get();

        $order = OrderNCC::where('ncc_id',Auth::user()->ncc_id)->whereIn('trangthai',[4,5])
                            ->select(DB::raw('count(*) count, SUM(tongtien) tongtien, MONTH(created_at) month'))
                            ->whereBetween('created_at',[$month_start,$month_end])
                            ->groupBy('month')
                            ->get();
        
        foreach ($receipt as $item){
            $sum_receipt += $item['tongtien'];
        }

        foreach ($order as $item){
            $sum_order += $item['tongtien'];
        }

        $sum_sales = $sum_order - $sum_receipt;

        foreach ($arrMonthNumber as $month){
            $total_receipt = 0;
            $total_order = 0;
            $total_sales = 0;

            foreach ($receipt as $item){
                if($item['month'] == $month){
                    $total_receipt = $item['tongtien'];
                }
            }

            foreach ($order as $item){
                if($item['month'] == $month){
                    $total_order = $item['tongtien'];
                }
            }
            $total_sales = $total_order -  $total_receipt;
            $arr_receipt[] = $total_receipt;
            $arr_order[] = $total_order;
            $arr_sales[] = $total_sales;
        }

        $arr_3month_sales = [
            'arr_receipt' => JSON_ENCODE($arr_receipt),
            'arr_order' => JSON_ENCODE($arr_order),
            'arr_sales' => JSON_ENCODE($arr_sales),
            'arrMonth' => JSON_ENCODE($arrMonth),
        ];

        return response()->json([
            'code' => 200,
            'output' => $arr_3month_sales,
            'sum_receipt' => number_format($sum_receipt),
            'sum_order' => number_format($sum_order),
            'sum_sales' => number_format($sum_sales),
        ]);
    }

    public function fillByDate(Request $request){
       $dateStart = $request->dateStart;
       $dateEnd = $request->dateEnd;

       $arr_receipt = [];
       $arr_order = [];
       $arr_sales = [];
       $arrDay = [];

       $sum_receipt = 0;
       $sum_order = 0;
       $sum_sales = 0;

       $receipt = Receipt::where('ncc_id',Auth::user()->ncc_id)->where('pnh_trangthai',1)
                            ->select(DB::raw('count(*) count, SUM(pnh_tongcong) tongtien, DATE(created_at) day'))
                            ->whereBetween('created_at',[$dateStart,$dateEnd])
                            ->groupBy('day')
                            ->get();

        $order = OrderNCC::where('ncc_id',Auth::user()->ncc_id)->whereIn('trangthai',[4,5])
                            ->select(DB::raw('count(*) count, SUM(tongtien) tongtien, DATE(created_at) day'))
                            ->whereBetween('created_at',[$dateStart,$dateEnd])
                            ->groupBy('day')
                            ->get();

        foreach ($receipt as $item){
            $sum_receipt += $item['tongtien'];
        }

        foreach ($order as $item){
            $sum_order += $item['tongtien'];
        }

        $sum_sales = $sum_order - $sum_receipt;

        $period = CarbonPeriod::create($request->dateStart, $request->dateEnd);

        foreach ($period as $date) {
            $arrDay[] = $date->format('Y-m-d');
        }

        foreach($arrDay as $day) {
            $total_receipt = 0;
            $total_order = 0;
            $total_sales = 0;
            foreach($receipt as $item){
                if($item['day'] == $day){
                    $total_receipt = $item['tongtien'];
                    break;
                }
            }
            foreach($order as $item){
                if($item['day'] == $day){
                    $total_order = $item['tongtien'];
                    break;
                }
            }
            $total_sales = $total_order - $total_receipt;
            $arr_sales[] = $total_sales;
            $arr_order[] = $total_order;
            $arr_receipt[] = $total_receipt;
        }

        $arr_date_sales = [
            'arr_order' => JSON_ENCODE($arr_order),
            'arr_receipt' => JSON_ENCODE($arr_receipt),
            'arr_sales' => JSON_ENCODE($arr_sales),
            'arrDay' => JSON_ENCODE($arrDay),
        ];

        return response()->json([
            'code' => 200,
            'output' => $arr_date_sales,
            'sum_receipt' => number_format($sum_receipt),
            'sum_order' => number_format($sum_order),
            'sum_sales' => number_format($sum_sales),
        ]);
    }
}
