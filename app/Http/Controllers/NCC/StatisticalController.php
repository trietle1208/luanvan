<?php

namespace App\Http\Controllers\NCC;

use App\Http\Controllers\Controller;
use App\Models\OrderNCC;
use App\Models\Receipt;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StatisticalController extends Controller
{
    //Thống kê hóa đơn
    public function order(){
        //Thống kê theo trạng thái đơn hàng
        $arr_count_order = [];
        $arr_name_order = [];
        $arr_color_order = [];
        $count_order = OrderNCC::where('ncc_id',Auth::user()->ncc_id)
        ->select(DB::raw('count(*) as count, trangthai'))
        ->groupBy('trangthai')
        ->get();
        foreach ($count_order as $item) {
            switch ($item['trangthai']) {
                case '0':
                    $status = 'Chưa duyệt';
                    $color = '#6c757d';
                    break;
                case '1':
                    $status = 'Đã xác nhận';
                    $color = '#4a81d4';
                    break;
                case '2':
                    $status = 'Đã hủy';
                    $color = '#f1556c';
                    break;
                case '3':
                    $status = 'Giao hàng';
                    $color = '#fd7e14';
                    break;
                case '4':
                    $status = 'Chờ xác nhận';
                    $color = '#9400D3';
                    break;
                default:
                    $status = 'Hoàn thành';
                    $color = '#1abc9c';
                    break;
            }
            $arr_count_order[] = (int)$item['count'];
            $arr_name_order[] = (string)$status;
            $arr_color_order[] = (string)$color;
        }
        
        //Thống kê theo tổng tiền đơn hàng
        $arr_count_total_order =[];
        // $arr_name_total_order = ['Bình thường','Ổn','Cao','Rất cao'];
        $arr_name_total_order = ['0 - 5,500,000','5,500,000 - 10,000,000','10,000,000 - 20,000,000','>= 20,000,000'];
        $arr_color_total_order = ['#6c757d','#4a81d4','#9400D3','#1abc9c'];
        $count_small = 0;
        $count_medium = 0;
        $count_large = 0;
        $count_big = 0;

        $count_order_total_small = OrderNCC::where('ncc_id',Auth::user()->ncc_id)
        ->select(DB::raw('count(*) as count, tongtien'))
        ->groupBy('tongtien')
        ->havingRaw('tongtien BETWEEN 0 AND 5500000')
        ->get();

        $count_order_total_medium = OrderNCC::where('ncc_id',Auth::user()->ncc_id)
        ->select(DB::raw('count(*) as count, tongtien'))
        ->groupBy('tongtien')
        ->havingRaw('tongtien BETWEEN 5500000 AND 10000000')
        ->get();

        $count_order_total_large = OrderNCC::where('ncc_id',Auth::user()->ncc_id)
        ->select(DB::raw('count(*) as count, tongtien'))
        ->groupBy('tongtien')
        ->havingRaw('tongtien BETWEEN 10000000 AND 20000000')
        ->get();

        $count_order_total_big = OrderNCC::where('ncc_id',Auth::user()->ncc_id)
        ->select(DB::raw('count(*) as count, tongtien'))
        ->groupBy('tongtien')
        ->having('tongtien','>=',20000000)
        ->get();
 
        if($count_order_total_small){
            foreach ($count_order_total_small as $item){
                $count_small += (int)$item['count'];
            }
            $arr_count_total_order[0] = $count_small;
        }else{
            $arr_count_total_order[0] = 0;
        }

        if($count_order_total_medium){
            foreach ($count_order_total_medium as $item){
                $count_medium += (int)$item['count'];
            }
            $arr_count_total_order[1] = $count_medium;
        }else{
            $arr_count_total_order[1] = 0;
        }

        if($count_order_total_large){
            foreach ($count_order_total_large as $item){
                $count_large += (int)$item['count'];
            }
            $arr_count_total_order[2] = $count_large;
        }else{
            $arr_count_total_order[2] = 0;
        }
        
        if($count_order_total_big){
            foreach ($count_order_total_big as $item){
                $count_big += (int)$item['count'];
            }
            $arr_count_total_order[3] = $count_big;
        }else{
            $arr_count_total_order[3] = 0;
        }
       
        //Thống kê theo tất cả tháng đơn hàng
        $arr_month_order = [];
        $arr_count_success_month_order = [];
        $arr_count_delete_month_order = [];
        $count_order_by_month_delete = OrderNCC::where('ncc_id',Auth::user()->ncc_id)
        ->select(DB::raw('count(*) as count, trangthai, MONTH(created_at) month'))
        ->groupBy('trangthai','month')
        ->orHaving('trangthai','=',2)
        ->get();
        $count_order_by_month_success = OrderNCC::where('ncc_id',Auth::user()->ncc_id)
        ->select(DB::raw('count(*) as count, trangthai, MONTH(created_at) month'))
        ->groupBy('trangthai','month')
        ->orHaving('trangthai','=',5)
        ->get();
        $arr_month = [1,2,3,4,5,6,7,8,9,10,11,12];
        foreach($arr_month as $month) {
            $count = 0;
            foreach($count_order_by_month_success as $item){
                if($item['month'] == $month){
                    if($item['trangthai'] == 5){
                        $count = (int)$item['count'];
                        break;
                    }
                }
            }
            $arr_count_success_month_order[] = $count;
            
        }

        foreach($arr_month as $month) {
            $count = 0;
            foreach($count_order_by_month_delete as $item){
                if($item['month'] == $month){
                    if($item['trangthai'] == 2){
                        $count = (int)$item['count'];
                        break;
                    }
                }
            }
            $arr_count_delete_month_order[] = $count;
            
        }
        
        $arr_order = [
            'arr_count_order' => json_encode($arr_count_order),
            'arr_name_order' => json_encode($arr_name_order),
            'arr_color_order' => json_encode($arr_color_order),
            'arr_count_total_order' => json_encode($arr_count_total_order),
            'arr_name_total_order' => json_encode($arr_name_total_order),
            'arr_color_total_order' => json_encode($arr_color_total_order),
            'arr_count_success_month_order' => json_encode($arr_count_success_month_order),
            'arr_count_delete_month_order' => json_encode($arr_count_delete_month_order),
        ];
        return view('admin.nhacungcap.statistical.order.index',$arr_order);
    }

    //Thống kê theo từng tháng
    public function fillByMonth(Request $request){
        $arr_count_order_success = [];
        $arr_count_order_delete = [];
        $arr_month_order = [];
        $arrDay = [];
        $count_success = 0;
        $count_delete = 0;
        $year = Carbon::parse($request->month)->format('Y');
        $month = Carbon::parse($request->month)->format('m');

        $count_order = OrderNCC::where('ncc_id',Auth::user()->ncc_id)
        ->select(DB::raw('count(*) as count, trangthai'))
        ->whereMonth('created_at','=',$month)
        ->groupBy('trangthai')
        ->get();

        foreach ($count_order as $item){
            if($item['trangthai'] == 2){
                $count_delete = $item['count'];
            }
            else if($item['trangthai'] == 5)
            {
                $count_success = $item['count'];
            }
        }
        $count_order_delete = OrderNCC::where('ncc_id',Auth::user()->ncc_id)
        ->select(DB::raw('count(*) as count, trangthai, DATE(created_at) day'))
        ->whereMonth('created_at','=',$month)
        ->groupBy('trangthai','day')
        ->Having('trangthai','=',2)
        ->get();

        $count_order_success = OrderNCC::where('ncc_id',Auth::user()->ncc_id)
        ->select(DB::raw('count(*) as count, trangthai, DATE(created_at) day'))
        ->whereMonth('created_at','=',$month)
        ->groupBy('trangthai','day')
        ->Having('trangthai','=',5)
        ->get();
        for($day = 1 ; $day <= 31; $day++){
            $time = mktime(12,0,0, $month, $day, $year);
            if(date('m',$time) == $month){
                $arrDay[] = date('Y-m-d',$time);
            }
        }
        
        foreach($arrDay as $day) {
            $count = 0;
            foreach($count_order_delete as $item){
                if($item['day'] == $day){
                    $count = $item['count'];
                    break;
                }
            }
            $arr_count_order_delete[] = $count;
        }

        foreach($arrDay as $day) {
            $count = 0;
            foreach($count_order_success as $item){
                if($item['day'] == $day){
                    $count = $item['count'];
                    break;
                }
            }
            $arr_count_order_success[] = $count;
        }

        $arr_month_order = 
        [
            'arr_count_order_success' => json_encode($arr_count_order_success),
            'arr_count_order_delete' => json_encode($arr_count_order_delete),
            'arrDay' => json_encode($arrDay),
        ];

        return response()->json([
            'code' => 200,
            'output' => $arr_month_order,
            'count_success' => $count_success,
            'count_delete' => $count_delete,
        ]);
    }

    //Thống kê theo từng quý
    public function fillBy3Month(Request $request){
        $arr_count_order_success = [];
        $arr_count_order_delete = [];
        $count_success = 0;
        $count_delete = 0;
        $arrDayStart = [];
        $arrDayEnd = [];
        $arrMonth =[];
        $arrMonthNumber=[];
        $month_start = '';
        $month_end = '';
        $year = $request->year;
        if($request){
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
            
            $count_order = OrderNCC::where('ncc_id',Auth::user()->ncc_id)
            ->select(DB::raw('count(*) as count, trangthai, MONTH(created_at) month'))
            ->whereBetween('created_at',[$month_start,$month_end])
            ->groupBy('trangthai','month')
            ->get();

            $count_order_success = OrderNCC::where('ncc_id',Auth::user()->ncc_id)
            ->select(DB::raw('count(*) as count, trangthai, MONTH(created_at) month'))
            ->whereBetween('created_at',[$month_start,$month_end])
            ->groupBy('trangthai','month')
            ->having('trangthai','=',5)
            ->get();

            $count_order_delete = OrderNCC::where('ncc_id',Auth::user()->ncc_id)
            ->select(DB::raw('count(*) as count, trangthai, MONTH(created_at) month'))
            ->whereBetween('created_at',[$month_start,$month_end])
            ->groupBy('trangthai','month')
            ->having('trangthai','=',2)
            ->get();

            foreach ($count_order as $item){
                if($item['trangthai'] == 2){
                    $count_delete = $item['count'];
                }
                else if($item['trangthai'] == 5)
                {
                    $count_success = $item['count'];
                }
            }

            foreach ($arrMonthNumber as $month){
                $count = 0;
                foreach ($count_order_success as $item){
                    if($item['month'] == $month){
                        $count = $item['count'];
                        break;
                    }
                }
                $arr_count_order_success[] = $count;
            }

            foreach ($arrMonthNumber as $month){
                $count = 0;
                foreach ($count_order_delete as $item){
                    if($item['month'] == $month){
                        $count = $item['count'];
                        break;
                    }
                }
                $arr_count_order_delete[] = $count;
            }

            $arr_month_order = [
                'arr_count_order_success' => json_encode($arr_count_order_success),
                'arr_count_order_delete' => json_encode($arr_count_order_delete),
                'arrMonth' => json_encode($arrMonth),
            ];

            return response()->json([
                'code' => 200,
                'output' => $arr_month_order,
                'count_success' => $count_success,
                'count_delete' => $count_delete,
            ]);
        }
    }
}
