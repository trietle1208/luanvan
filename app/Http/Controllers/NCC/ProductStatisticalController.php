<?php

namespace App\Http\Controllers\NCC;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductStatisticalController extends Controller
{
    public function index(Request $request)
    {   
        $product = Product::where('ncc_id',Auth::user()->ncc_id)->get();
        $count_product = $product->count();
        $comment = Product::where('ncc_id',Auth::user()->ncc_id)->withCount('comment')->get();

        $count_comment = 0;
        foreach($comment as $item){
            $count_comment += (int)$item->comment_count;
        }
        $view = Product::where('ncc_id',Auth::user()->ncc_id)->withCount('view')->get();

        $count_view = 0;
        foreach($view as $item){
            $count_view += (int)$item->view_count;
        }

        $product_sell = Product::where('ncc_id',Auth::user()->ncc_id)->withSum('orderdetail','soluong')->orderBy('orderdetail_sum_soluong','DESC')->take(5)->get();
        return view('admin.nhacungcap.statistical.product.index',compact('count_product','count_comment','count_view','product_sell'));
    }


    //lọc sản phẩm theo tiếu chí tốt
    public function fillGood(Request $request)
    {
        if($request){
            if($request->type == 1){
                $products = Product::where('ncc_id',Auth::user()->ncc_id)
                                    ->withSum('orderdetail','soluong')
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
                            ->withAvg('rating','bl_sosao')
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
}
