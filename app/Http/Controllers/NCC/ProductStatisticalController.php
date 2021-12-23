<?php

namespace App\Http\Controllers\NCC;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductStatisticalController extends Controller
{
    public function index(Request $request){   
        $product = Product::where('ncc_id',Auth::user()->ncc_id)->get();
        
        $comment = Product::where('ncc_id',Auth::user()->ncc_id)
                            ->withCount(['comment' => function($query){
                            $query->where('binhluan.trangthai',1);
                            }])->get();
        $view = Product::where('ncc_id',Auth::user()->ncc_id)->withCount('view')->get();
        
        $product_sell = Product::where('ncc_id',Auth::user()->ncc_id)
                                ->whereHas('orderdetail')
                                ->withSum(['orderdetail' => function ($query){
                                    $query->whereHas('order_ncc',function ($query1){
                                        $query1->where('trangthai',5)
                                                ->whereHas('orderAdmin', function ($query2){
                                                    $query2->where('dh_trangthai',5);
                                                });
                                    });
                                }],'soluong')
                                ->orderBy('orderdetail_sum_soluong','DESC')
                                ->take(5)->get();
        $comments = Comment::where('trangthai',1)
                    ->whereHas('product')
                    ->with(['product'=> function($query){
                    $query->where('ncc_id',Auth::user()->ncc_id);
        }])
        ->with('customer')
        ->orderBy('created_at','DESC')
        ->get();
        $arr_product_sell = [];
        $arr_product_sell[0][] = [];
        $arr_product_sell[1][] = [];

        $product_count = Product::where('ncc_id',Auth::user()->ncc_id)
                        ->whereHas('orderdetail')
                        ->withSum(['orderdetail' => function ($query){
                            $query->whereHas('order_ncc',function ($query1){
                                $query1->where('trangthai',5)
                                        ->whereHas('orderAdmin', function ($query2){
                                            $query2->where('dh_trangthai',5);
                                        });
                            });
                        }],'soluong')
                        ->get();
        
        if(!$product_count->isEmpty()){
            foreach($product_count as $key => $item){
            
                if($item['orderdetail_sum_soluong'] != NULL){
                    $arr_product_sell[0][] = $item['sp_ten'];
                    $arr_product_sell[1][] = (int)$item['orderdetail_sum_soluong'];
                }else{
                    $product_count->forget($key);
                }
            }
        }
        
        // dd($comment->count());
        $product_sales = Product::where('ncc_id',Auth::user()->ncc_id)
                        ->whereHas('orderdetail')
                        ->with(['orderdetail' => function ($query){
                            $query->whereHas('order_ncc',function ($query1){
                                $query1->where('trangthai',5)
                                        ->whereHas('orderAdmin', function ($query2){
                                            $query2->where('dh_trangthai',5);
                                        });
                            });
                        }])
                        ->whereHas('detailreceipt')
                        ->with(['detailreceipt' => function ($query){
                            $query->whereHas('receipt',function ($query1){
                                $query1->where('pnh_trangthai',1);
                            });
                        }])
                        ->get();
        $arr_product_sales = [];
        $arr_product_sales[0] = [];
        $arr_product_sales[1] = [];
        $arr_product_total_sales = [];
        $arr_product_total_receipt = [];
        $total_sales = 0;
        $total_receipt = 0;
        foreach($product_sales as $item){
            $total_sales = 0;
            if($item['orderdetail'] != null){
                foreach($item['orderdetail'] as $row){
                    $total_sales += (int)$row['gia'] * (int)$row['soluong'];
                }
                $arr_product_total_sales[] = (int)$total_sales;
            }
        }
        foreach ($product_sales as $item){
            $total_receipt = 0;
            foreach($item['detailreceipt'] as $row){
                $total_receipt += (int)$row['giagoc'] * (int)$row['soluonggoc'];
            }
            $arr_product_total_receipt[] = (int)$total_receipt;
        }
        
        foreach($product_sales as $key => $item){
            $arr_product_sales[0][] = $item['sp_ten'];
            $arr_product_sales[1][] = (int)$arr_product_total_sales[$key] - (int)$arr_product_total_receipt[$key];
        }

        foreach ($product_sales as $key => $product1){
            $total_sales = 0;
            if($product1['orderdetail'] != null){
                foreach($product1['orderdetail'] as $row){
                    $total_sales += (int)$row['gia'] * (int)$row['soluong'];
                }
            }
            $total_receipt = 0;
                foreach($product1['detailreceipt'] as $row){
                    $total_receipt += (int)$row['giagoc'] * (int)$row['soluonggoc'];
                }
            $total = $total_sales - $total_receipt;
            $product_sales[$key]['total'] = $total;
        }
        $arr = [
            'arr_product_name' => JSON_ENCODE($arr_product_sell[0]),
            'arr_product_qty' => JSON_ENCODE($arr_product_sell[1]),
            'arr_product_name_sales' => JSON_ENCODE($arr_product_sales[0]),
            'arr_product_sales' => JSON_ENCODE($arr_product_sales[1]),
        ];
        return view('admin.nhacungcap.statistical.product.index',compact('product','comment','view','product_sell','comments','product_count','product_sales'),$arr);
    }

    //lọc sản phẩm theo tiếu chí tốt
    public function fillGood(Request $request){
        if($request){
            if($request->type == 1){
                $products = Product::where('ncc_id',Auth::user()->ncc_id)
                                    ->withSum(['orderdetail' => function ($query){
                                        $query->whereHas('order_ncc',function ($query1){
                                            $query1->where('trangthai',5)
                                                    ->whereHas('orderAdmin', function ($query2){
                                                        $query2->where('dh_trangthai',5);
                                                    });
                                        });
                                    }],'soluong')
                                    ->orderBy('orderdetail_sum_soluong','DESC')
                                    ->take(5)
                                    ->get();
                return response()->json([
                    'code' => 200,
                    'output' => view('admin.nhacungcap.statistical.product.fill-table',compact('products'))->render(),
                ]);                                   
            }else if($request->type == 2){
                $products = Product::where('ncc_id',Auth::user()->ncc_id)
                            ->withCount('view')
                            ->orderBy('view_count','DESC')
                            ->take(5)
                            ->get();
                return response()->json([
                    'code' => 200,
                    'output' => view('admin.nhacungcap.statistical.product.fill-table',compact('products'))->render(),
                ]);
            }else if($request->type == 3){
                $products = Product::where('ncc_id',Auth::user()->ncc_id)
                            ->withCount('wishlist')
                            ->orderBy('wishlist_count','DESC')
                            ->having('wishlist_count','>',0)
                            ->take(5)
                            ->get();
                return response()->json([
                    'code' => 200,
                    'output' => view('admin.nhacungcap.statistical.product.fill-table',compact('products'))->render(),
                ]);
            }else{
                $products = Product::where('ncc_id',Auth::user()->ncc_id)
                            ->withAvg(['rating' => function ($query){
                                $query->where('binhluan.trangthai',1);
                            }],'bl_sosao')
                            ->orderBy('rating_avg_bl_sosao','DESC')
                            ->having('rating_avg_bl_sosao','>',0)
                            ->take(5)
                            ->get();
                return response()->json([
                    'code' => 200,
                    'output' => view('admin.nhacungcap.statistical.product.fill-table',compact('products'))->render(),
                ]);
            }
        }
    }
    //chi tiết sản phẩm
    public function detail(Request $request){
        $product = Product::find($request->id);
        return response()->json([
            'code' =>200,
            'output' => view('admin.nhacungcap.statistical.product.detail',compact('product'))->render(),
        ]);
    }

    //Lọc sản phẩm bán chạy theo tháng
    public function fillProductByMonth(Request $request){
        $month = Carbon::parse($request->month)->format('m');
        $product = Product::where('ncc_id',Auth::user()->ncc_id)
                        ->whereHas('orderdetail')
                        ->withSum(['orderdetail' => function ($query) use ($month){
                            $query->whereHas('order_ncc',function ($query1){
                                $query1->where('trangthai',5)
                                        ->whereHas('orderAdmin', function ($query2){
                                            $query2->where('dh_trangthai',5);
                                        });
                            })->whereMonth('created_at',$month);
                        }],'soluong')
                        ->get();
        
        $arr_product_sell_month = [];
        foreach($product as $key => $item){
            if($item['orderdetail_sum_soluong'] != null){
                $arr_product_sell_month[0][] = $item['sp_ten'];
                $arr_product_sell_month[1][] = (int)$item['orderdetail_sum_soluong'];
            }else{
                $product->forget($key);
            }
        }
        if($arr_product_sell_month != null){
            $arr = [
                'arr_product_name' => $arr_product_sell_month[0],
                'arr_product_qty' => $arr_product_sell_month[1],
            ];
        }else{
            $arr = [];
        }
        if($arr != null){
            return response()->json([
                'code' => 200,
                'arr' => $arr,
                'product' => $product,
            ]);
        }else{
            return response()->json([
                'code' => 400,
            ]);
        }
        
    }

    //Lọc sản phẩm bán chạy theo quý
    public function fillProductBy3Month(Request $request){
        $year = Carbon::parse($request->year)->format('y');
        $month_start = 0;
        $month_end = 0;
        $arrDayStart = [];
        $arrDayEnd = [];

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
        }
        $product = Product::where('ncc_id',Auth::user()->ncc_id)
                        ->whereHas('orderdetail')
                        ->withSum(['orderdetail' => function ($query) use ($month_start, $month_end){
                            $query->whereHas('order_ncc',function ($query1){
                                $query1->where('trangthai',5)
                                        ->whereHas('orderAdmin', function ($query2){
                                            $query2->where('dh_trangthai',5);
                                        });
                            })->whereBetween('created_at',[$month_start,$month_end]);
                        }],'soluong')
                        ->get();
        $arr_product_sell_month = [];
        foreach($product as $key => $item){
            
            if($item['orderdetail_sum_soluong'] != null){
                $arr_product_sell_month[0][] = $item['sp_ten'];
                $arr_product_sell_month[1][] = (int)$item['orderdetail_sum_soluong'];
            }else{
                $product->forget($key);
            }
        }
        
        if($arr_product_sell_month != null){
            $arr = [
                'arr_product_name' => $arr_product_sell_month[0],
                'arr_product_qty' => $arr_product_sell_month[1],
            ];
        }else{
            $arr = [];
        }
        if($arr != null){
            return response()->json([
                'code' => 200,
                'arr' => $arr,
                'product' => $product,
            ]);
        }else{
            return response()->json([
                'code' => 400,
            ]);
        }
    }

    //Lọc sản phẩm bán chạy theo ngày
    public function fillProductByDate(Request $request){
        $dateStart = $request->dateStart;
        $dateEnd = $request->dateEnd;

        $product = Product::where('ncc_id',Auth::user()->ncc_id)
                        ->whereHas('orderdetail')
                        ->withSum(['orderdetail' => function ($query) use ($dateStart, $dateEnd){
                            $query->whereHas('order_ncc',function ($query1){
                                $query1->where('trangthai',5)
                                        ->whereHas('orderAdmin', function ($query2){
                                            $query2->where('dh_trangthai',5);
                                        });
                            })->whereBetween('created_at',[$dateStart,$dateEnd]);
                        }],'soluong')
                        ->get();
        $arr_product_sell_month = [];
        foreach($product as $key => $item){
            
            if($item['orderdetail_sum_soluong'] != null){
                $arr_product_sell_month[0][] = $item['sp_ten'];
                $arr_product_sell_month[1][] = (int)$item['orderdetail_sum_soluong'];
            }else{
                $product->forget($key);
            }
        }

        if($arr_product_sell_month != null){
            $arr = [
                'arr_product_name' => $arr_product_sell_month[0],
                'arr_product_qty' => $arr_product_sell_month[1],
            ];
        }else{
            $arr = [];
        }
        if($arr != null){
            return response()->json([
                'code' => 200,
                'arr' => $arr,
                'product' => $product,
            ]);
        }else{
            return response()->json([
                'code' => 400,
            ]);
        }
    }

    //Lọc doanh thu sản phẩm theo tháng
    public function fillProductSalesByMonth(Request $request){
        $month = Carbon::parse($request->month)->format('m');
        $product_sales = Product::where('ncc_id',Auth::user()->ncc_id)
                        ->whereHas('orderdetail')
                        ->with(['orderdetail' => function ($query) use ($month){
                            $query->whereHas('order_ncc',function ($query1){
                                $query1->where('trangthai',5)
                                        ->whereHas('orderAdmin', function ($query2){
                                            $query2->where('dh_trangthai',5);
                                        });
                            })->whereMonth('created_at',$month);
                        }])
                        ->whereHas('detailreceipt')
                        ->with(['detailreceipt' => function ($query) use ($month){
                            $query->whereHas('receipt',function ($query1){
                                $query1->where('pnh_trangthai',1);
                            })->whereMonth('created_at',$month);
                        }])
                        ->get();

        $arr_product_sales = [];
        $arr_product_total_sales = [];
        $arr_product_total_receipt = [];
        $total_sales = 0;
        $total_receipt = 0;
        foreach($product_sales as $item){
            $total_sales = 0;
            if($item['orderdetail'] != null){
                foreach($item['orderdetail'] as $row){
                    $total_sales += (int)$row['gia'] * (int)$row['soluong'];
                }
                $arr_product_total_sales[] = (int)$total_sales;
            }
        }
        foreach ($product_sales as $item){
            $total_receipt = 0;
            if($item['detailreceipt'] != null){
                foreach($item['detailreceipt'] as $row){
                    $total_receipt += (int)$row['giagoc'] * (int)$row['soluonggoc'];
                }
                $arr_product_total_receipt[] = (int)$total_receipt;
            }
        }
        
        foreach($product_sales as $key => $item){
            $arr_product_sales[0][] = $item['sp_ten'];
            $arr_product_sales[1][] = (int)$arr_product_total_sales[$key] - (int)$arr_product_total_receipt[$key];
        }

        $arr = [
            'arr_product_name_sales' => $arr_product_sales[0],
            'arr_product_sales' => $arr_product_sales[1],
        ];
        foreach ($product_sales as $key =>$product){
            $total_sales = 0;
            if($product['orderdetail'] != null){
                foreach($product['orderdetail'] as $row){
                    $total_sales += (int)$row['gia'] * (int)$row['soluong'];
                }
            }
            $total_receipt = 0;
                foreach($product['detailreceipt'] as $row){
                    $total_receipt += (int)$row['giagoc'] * (int)$row['soluonggoc'];
                }
            $total = $total_sales - $total_receipt;
            $product_sales[$key]['total'] = $total;
        }
        return response()->json([
            'code' => 200,
            'arr' => $arr,
            'product_sales' => $product_sales,
        ]);
    }

    public function fillProductSalesBy3Month(Request $request){
        $year = Carbon::parse($request->month)->format('y');
        $month_start = 0;
        $month_end = 0;
        $arrDayStart = [];
        $arrDayEnd = [];

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
        }

        $product_sales = Product::where('ncc_id',Auth::user()->ncc_id)
                        ->whereHas('orderdetail')
                        ->with(['orderdetail' => function ($query) use ($month_start,$month_end){
                            $query->whereHas('order_ncc',function ($query1){
                                $query1->where('trangthai',5)
                                        ->whereHas('orderAdmin', function ($query2){
                                            $query2->where('dh_trangthai',5);
                                        });
                            })->whereBetween('created_at',[$month_start,$month_end]);
                        }])
                        ->whereHas('detailreceipt')
                        ->with(['detailreceipt' => function ($query) use ($month_start,$month_end){
                            $query->whereHas('receipt',function ($query1){
                                $query1->where('pnh_trangthai',1);
                            })->whereBetween('created_at',[$month_start,$month_end]);
                        }])
                        ->get();
        
        $arr_product_sales = [];
        $arr_product_total_sales = [];
        $arr_product_total_receipt = [];
        $total_sales = 0;
        $total_receipt = 0;
        foreach($product_sales as $item){
            $total_sales = 0;
            if($item['orderdetail'] != null){
                foreach($item['orderdetail'] as $row){
                    $total_sales += (int)$row['gia'] * (int)$row['soluong'];
                }
                $arr_product_total_sales[] = (int)$total_sales;
            }
        }
        foreach ($product_sales as $item){
            $total_receipt = 0;
            if($item['detailreceipt'] != null){
                foreach($item['detailreceipt'] as $row){
                    $total_receipt += (int)$row['giagoc'] * (int)$row['soluonggoc'];
                }
                $arr_product_total_receipt[] = (int)$total_receipt;
            }
        }
        
        foreach($product_sales as $key => $item){
            $arr_product_sales[0][] = $item['sp_ten'];
            $arr_product_sales[1][] = (int)$arr_product_total_sales[$key] - (int)$arr_product_total_receipt[$key];
        }

        $arr = [
            'arr_product_name_sales' => $arr_product_sales[0],
            'arr_product_sales' => $arr_product_sales[1],
        ];
        foreach ($product_sales as $key =>$product){
            $total_sales = 0;
            if($product['orderdetail'] != null){
                foreach($product['orderdetail'] as $row){
                    $total_sales += (int)$row['gia'] * (int)$row['soluong'];
                }
            }
            $total_receipt = 0;
                foreach($product['detailreceipt'] as $row){
                    $total_receipt += (int)$row['giagoc'] * (int)$row['soluonggoc'];
                }
            $total = $total_sales - $total_receipt;
            $product_sales[$key]['total'] = $total;
        }
        return response()->json([
            'code' => 200,
            'arr' => $arr,
            'product_sales' => $product_sales,
        ]);
    }

    //lọc doanh thu sản phẩm theo ngày
    public function fillProductSalesByDate(Request $request){
        $dateStart = $request->dateStart;
        $dateEnd = $request->dateEnd;
        $product_sales = Product::where('ncc_id',Auth::user()->ncc_id)
                        ->whereHas('orderdetail')
                        ->with(['orderdetail' => function ($query) use ($dateStart,$dateEnd){
                            $query->whereHas('order_ncc',function ($query1){
                                $query1->where('trangthai',5)
                                        ->whereHas('orderAdmin', function ($query2){
                                            $query2->where('dh_trangthai',5);
                                        });
                            })->whereBetween('created_at',[$dateStart,$dateEnd]);
                        }])
                        ->whereHas('detailreceipt')
                        ->with(['detailreceipt' => function ($query) use ($dateStart,$dateEnd){
                            $query->whereHas('receipt',function ($query1){
                                $query1->where('pnh_trangthai',1);
                            })->whereBetween('created_at',[$dateStart,$dateEnd]);
                        }])
                        ->get();

        $arr_product_sales = [];
        $arr_product_total_sales = [];
        $arr_product_total_receipt = [];
        $total_sales = 0;
        $total_receipt = 0;
        dd($product_sales->toArray());
        foreach($product_sales as $item){
            $total_sales = 0;
            if($item['orderdetail'] != null){
                foreach($item['orderdetail'] as $row){
                    $total_sales += (int)$row['gia'] * (int)$row['soluong'];
                }
                $arr_product_total_sales[] = (int)$total_sales;
            }
        }
        foreach ($product_sales as $item){
            $total_receipt = 0;
            if($item['detailreceipt'] != null){
                foreach($item['detailreceipt'] as $row){
                    $total_receipt += (int)$row['giagoc'] * (int)$row['soluonggoc'];
                }
                $arr_product_total_receipt[] = (int)$total_receipt;
            }
        }
        
        foreach($product_sales as $key => $item){
            $arr_product_sales[0][] = $item['sp_ten'];
            $arr_product_sales[1][] = (int)$arr_product_total_sales[$key] - (int)$arr_product_total_receipt[$key];
        }

        $arr = [
            'arr_product_name_sales' => $arr_product_sales[0],
            'arr_product_sales' => $arr_product_sales[1],
        ];
        foreach ($product_sales as $key =>$product){
            $total_sales = 0;
            if($product['orderdetail'] != null){
                foreach($product['orderdetail'] as $row){
                    $total_sales += (int)$row['gia'] * (int)$row['soluong'];
                }
            }
            $total_receipt = 0;
                foreach($product['detailreceipt'] as $row){
                    $total_receipt += (int)$row['giagoc'] * (int)$row['soluonggoc'];
                }
            $total = $total_sales - $total_receipt;
            $product_sales[$key]['total'] = $total;
        }
        return response()->json([
            'code' => 200,
            'arr' => $arr,
            'product_sales' => $product_sales,
        ]);
    }
}

