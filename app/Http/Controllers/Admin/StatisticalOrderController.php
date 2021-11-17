<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticalOrderController extends Controller
{
    public function index()
    {   
    //thống kê trạng thái đơn hàng
        $arr_name = [];
        $arr_count = [];
        $arr_color = [];
        $orders = Order::select(DB::raw('count(*) as count, dh_trangthai trangthai'))
                              ->groupBy('trangthai')
                              ->get();

        foreach ($orders as $item) {
            switch ($item['trangthai']) {
                case '0':
                    $status = 'Chưa duyệt';
                    $color = '#6c757d';
                    break;
                case '1':
                    $status = 'Đã xác nhận';
                    $color = '#4a81d4';
                    break;
                case '4':
                    $status = 'Đã hủy';
                    $color = '#f1556c';
                    break;
                case '2':
                    $status = 'Giao hàng';
                    $color = '#fd7e14';
                    break;
                case '3':
                    $status = 'Chờ xác nhận';
                    $color = '#9400D3';
                    break;
                default:
                    $status = 'Hoàn thành';
                    $color = '#1abc9c';
                    break;
            }
            $arr_count[] = (int)$item['count'];
            $arr_name[] = (string)$status;
            $arr_color[] = (string)$color;
        }
    //thống kê giao dịch đơn hàng
        $orders_type = Order::where('dh_trangthai','!=',4)->get();

        $count_paypal = 0;
        $count_shipcode = 0;
        
        foreach ($orders_type as $item){
            if($item['ht_id'] == 1){
                $count_paypal++;
            }else{
                $count_shipcode++;
            }
        }

        $arr_type = [$count_shipcode,$count_paypal];
        $arr_name_type = ['Thanh toán trực tiếp','Thanh toán Paypal'];
        $arr_color_type = ['#4a81d4','#1abc9c'];

    //thống kê đơn hàng theo cả năm
        $orders_new = Order::select(DB::raw('count(*) as count,dh_trangthai trangthai, MONTH(dh_thoigiandathang) month'))
        ->groupBy('month','trangthai')
        ->having('trangthai','=',0)
        ->get();

        $orders_check = Order::select(DB::raw('count(*) as count,dh_trangthai trangthai, MONTH(dh_thoigiandathang) month'))
        ->groupBy('month','trangthai')
        ->having('trangthai','=',1)
        ->get();

        $orders_ship = Order::select(DB::raw('count(*) as count,dh_trangthai trangthai, MONTH(dh_thoigiandathang) month'))
        ->groupBy('month','trangthai')
        ->having('trangthai','=',2)
        ->get();

        $orders_delete= Order::select(DB::raw('count(*) as count,dh_trangthai trangthai, MONTH(dh_thoigiandathang) month'))
        ->groupBy('month','trangthai')
        ->having('trangthai','=',4)
        ->get();

        $orders_confirm= Order::select(DB::raw('count(*) as count,dh_trangthai trangthai, MONTH(dh_thoigiandathang) month'))
        ->groupBy('month','trangthai')
        ->having('trangthai','=',3)
        ->get();

        $orders_success= Order::select(DB::raw('count(*) as count,dh_trangthai trangthai, MONTH(dh_thoigiandathang) month'))
        ->groupBy('month','trangthai')
        ->having('trangthai','=',5)
        ->get();

        $arr_month = [1,2,3,4,5,6,7,8,9,10,11,12];

        foreach($arr_month as $month){
            $new = 0;
            $check = 0;
            $delete = 0;
            $ship = 0;
            $confirm = 0;
            $success = 0;
            foreach ($orders_new as $item){
                if($item['month'] == $month){
                    $new = $item['count'];
                }
            }
            foreach ($orders_check as $item){
                if($item['month'] == $month){
                    $check = $item['count'];
                }
            }
            foreach ($orders_delete as $item){
                if($item['month'] == $month){
                    $delete = $item['count'];
                }
            }
            foreach ($orders_ship as $item){
                if($item['month'] == $month){
                    $ship = $item['count'];
                }
            }
            foreach ($orders_confirm as $item){
                if($item['month'] == $month){
                    $confirm = $item['count'];
                }
            }
            foreach ($orders_success as $item){
                if($item['month'] == $month){
                    $success = $item['count'];
                }
            }
            $arr_order_new[] = $new;
            $arr_order_check[] = $check;
            $arr_order_delete[] = $delete;
            $arr_order_ship[] = $ship;
            $arr_order_confirm[] = $confirm;
            $arr_order_success[] = $success;
        }
        
        $arr = [
            'arr_count_order' => json_encode($arr_count),
            'arr_name_order' => json_encode($arr_name),
            'arr_color_order' => json_encode($arr_color),

            'arr_count_type_order' => json_encode($arr_type),
            'arr_name_type_order' => json_encode($arr_name_type),
            'arr_color_type_order' => json_encode($arr_color_type),

            'arr_count_new_month_order' => json_encode($arr_order_new),
            'arr_count_check_month_order' => json_encode($arr_order_check),
            'arr_count_delete_month_order' => json_encode($arr_order_delete),
            'arr_count_ship_month_order' => json_encode($arr_order_ship),
            'arr_count_confirm_month_order' => json_encode($arr_order_confirm),
            'arr_count_success_month_order' => json_encode($arr_order_success),
        ];
        return view('admin.manager.statistical.order.index',$arr);
    }

    public function fillOrderByMonth(Request $request)
    {
        $month = Carbon::parse($request->month)->format('m');
        $year = Carbon::parse($request->month)->format('Y');

        for($day = 1 ; $day <= 31; $day++){
            $time = mktime(12,0,0, $month, $day, $year);
            if(date('m',$time) == $month){
                $arrDay[] = date('Y-m-d',$time);
            }
        }
        $orders = Order::whereMonth('dh_thoigiandathang',$month)
                        ->select(DB::raw('count(*) as count, dh_trangthai trangthai,DATE(dh_thoigiandathang) day'))
                        ->groupBy('trangthai','day')
                        ->get();
        
        foreach ($arrDay as $day){
            $new = 0;
            $check = 0;
            $delete = 0;
            $ship = 0;
            $confirm = 0;
            $success = 0;
            foreach ($orders as $item){
                if($item['day'] == $day && $item['trangthai'] == 0){
                    $new = $item['count'];
                }
                if($item['day'] == $day && $item['trangthai'] == 1){
                    $check = $item['count'];
                }
                if($item['day'] == $day && $item['trangthai'] == 2){
                    $ship = $item['count'];
                }
                if($item['day'] == $day && $item['trangthai'] == 3){
                    $confirm = $item['count'];
                }
                if($item['day'] == $day && $item['trangthai'] == 4){
                    $delete = $item['count'];
                }
                if($item['day'] == $day && $item['trangthai'] == 5){
                    $success = $item['count'];
                }
            }
            $arr_order_new[] = $new;
            $arr_order_check[] = $check;
            $arr_order_delete[] = $delete;
            $arr_order_ship[] = $ship;
            $arr_order_confirm[] = $confirm;
            $arr_order_success[] = $success; 
        }
        $arr = [
            'arr_count_new_month_order' => json_encode($arr_order_new),
            'arr_count_check_month_order' => json_encode($arr_order_check),
            'arr_count_delete_month_order' => json_encode($arr_order_delete),
            'arr_count_ship_month_order' => json_encode($arr_order_ship),
            'arr_count_confirm_month_order' => json_encode($arr_order_confirm),
            'arr_count_success_month_order' => json_encode($arr_order_success),
            'arrDay' => json_encode($arrDay),
        ];

        return response()->json([
            'code' => 200,
            'output' => $arr,
        ]);
    }

    public function fillOrderBy3Month(Request $request)
    {
        switch ($request->type) {
            case '1':
                $x = 1;
                $y = 3;
                $arrMonth =['Tháng 1','Tháng 2','Tháng 3'];
                $arrMonthNumber=[1,2,3];
                break;
            case '2':
                $x = 4;
                $y = 6;
                $arrMonth =['Tháng 4','Tháng 5','Tháng 6'];
                $arrMonthNumber=[4,5,6];
                break;
            case '3':
                $x = 7;
                $y = 9;
                $arrMonth =['Tháng 7','Tháng 8','Tháng 9'];
                $arrMonthNumber=[7,8,9];
                break;
            default:
                $x = 10;
                $y = 12;
                $arrMonth =['Tháng 10','Tháng 11','Tháng 12'];
                $arrMonthNumber=[10,11,12];
                break;
        }
        for($day = 1 ; $day <= 31; $day++){
            $time = mktime(12,0,0, $x, $day, $request->year);
            if(date('m',$time) == (int)$x){
                $arrDayStart[] = date('Y-m-d',$time);
            }
        }
        for($day = 1 ; $day <= 31; $day++){
            $time = mktime(12,0,0, $y, $day, $request->year);
            if(date('m',$time) == (int)$y){
                $arrDayEnd[] = date('Y-m-d',$time);
            }
        }
        $month_start = reset($arrDayStart);
        $month_end = end($arrDayEnd);

        $orders = Order::select(DB::raw('count(*) as count,dh_trangthai trangthai, MONTH(dh_thoigiandathang) month'))
        ->whereBetween('dh_thoigiandathang',[$month_start,$month_end])
        ->groupBy('month','trangthai')
        ->get();

        foreach ($arrMonthNumber as $month){
            $new = 0;
            $check = 0;
            $delete = 0;
            $ship = 0;
            $confirm = 0;
            $success = 0;
            foreach ($orders as $item){
                if($item['month'] == $month && $item['trangthai'] == 0){
                    $new = $item['count'];
                }
                if($item['month'] == $month && $item['trangthai'] == 1){
                    $check = $item['count'];
                }
                if($item['month'] == $month && $item['trangthai'] == 2){
                    $ship = $item['count'];
                }
                if($item['month'] == $month && $item['trangthai'] == 3){
                    $confirm = $item['count'];
                }
                if($item['month'] == $month && $item['trangthai'] == 4){
                    $delete = $item['count'];
                }
                if($item['month'] == $month && $item['trangthai'] == 5){
                    $success = $item['count'];
                }
            }
            $arr_order_new[] = $new;
            $arr_order_check[] = $check;
            $arr_order_delete[] = $delete;
            $arr_order_ship[] = $ship;
            $arr_order_confirm[] = $confirm;
            $arr_order_success[] = $success; 
        }
        $arr = [
            'arr_count_new_month_order' => json_encode($arr_order_new),
            'arr_count_check_month_order' => json_encode($arr_order_check),
            'arr_count_delete_month_order' => json_encode($arr_order_delete),
            'arr_count_ship_month_order' => json_encode($arr_order_ship),
            'arr_count_confirm_month_order' => json_encode($arr_order_confirm),
            'arr_count_success_month_order' => json_encode($arr_order_success),
            'arrMonth' => json_encode($arrMonth),
        ];
        
        return response()->json([
            'code' => 200,
            'output' => $arr,
        ]);
    }

    public function fillOrderByDate(Request $request)
    {
        $period = CarbonPeriod::create($request->dateStart, $request->dateEnd);
        foreach ($period as $date) {
            $arrDay[] = $date->format('Y-m-d');
        }

        $orders = Order::select(DB::raw('count(*) as count,dh_trangthai trangthai, DATE(dh_thoigiandathang) day'))
        ->whereBetween('dh_thoigiandathang',[$request->dateStart,$request->dateEnd])
        ->groupBy('day','trangthai')
        ->get();

        foreach ($arrDay as $day){
            $new = 0;
            $check = 0;
            $delete = 0;
            $ship = 0;
            $confirm = 0;
            $success = 0;
            foreach ($orders as $item){
                if($item['day'] == $day && $item['trangthai'] == 0){
                    $new = $item['count'];
                }
                if($item['day'] == $day && $item['trangthai'] == 1){
                    $check = $item['count'];
                }
                if($item['day'] == $day && $item['trangthai'] == 2){
                    $ship = $item['count'];
                }
                if($item['day'] == $day && $item['trangthai'] == 3){
                    $confirm = $item['count'];
                }
                if($item['day'] == $day && $item['trangthai'] == 4){
                    $delete = $item['count'];
                }
                if($item['day'] == $day && $item['trangthai'] == 5){
                    $success = $item['count'];
                }
            }
            $arr_order_new[] = $new;
            $arr_order_check[] = $check;
            $arr_order_delete[] = $delete;
            $arr_order_ship[] = $ship;
            $arr_order_confirm[] = $confirm;
            $arr_order_success[] = $success; 
        }
        $arr = [
            'arr_count_new_month_order' => json_encode($arr_order_new),
            'arr_count_check_month_order' => json_encode($arr_order_check),
            'arr_count_delete_month_order' => json_encode($arr_order_delete),
            'arr_count_ship_month_order' => json_encode($arr_order_ship),
            'arr_count_confirm_month_order' => json_encode($arr_order_confirm),
            'arr_count_success_month_order' => json_encode($arr_order_success),
            'arrDay' => json_encode($arrDay),
        ];

        return response()->json([
            'code' => 200,
            'output' => $arr,
        ]);
    }
}
