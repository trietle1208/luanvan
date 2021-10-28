<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\CatePosts;
use App\Models\Customer;
use App\Models\DanhMuc;
use App\Models\DetailPara;
use App\Models\Product;
use App\Models\TypeProduct;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TypeController extends Controller
{
    public function index($slug, $id) {
        $cateposts = CatePosts::all();
        $categories = DanhMuc::all();
        $brands = Brand::all();
        $type = TypeProduct::find($id);
        $products = Product::where('sp_trangthai',1)->where('loaisp_id',$id)->get();
        $cate_fill = DanhMuc::where('dm_id',$type->dm_id)->first();
        $id_customer = Session::get('customer_id');
        if(isset($id_customer)){
            $customer = Customer::find($id_customer);
            $wishlist = Wishlist::where('kh_id',$id_customer)->get();
            return view('home.product.type.list',compact('categories','brands','products','wishlist','customer','cateposts','type','id'));
        }else{
            return view('home.product.type.list',compact('categories','brands','products','cateposts','type','id'));
        }
    }

    public function fillterPara(Request $request){
        $id_customer = Session::get('customer_id');
        $id_type = (int)$request->id_type;
        if($request->arr_value){
            $detail_paras = DetailPara::whereIn('chitietthongso',$request->arr_value)->with('product', function ($query){
                $query->where('sp_trangthai',1);
            })->get();
            if(isset($id_customer)) {
                $customer = Customer::find($id_customer);
                $wishlist = Wishlist::where('kh_id', $id_customer)->get();
                return response()->json([
                    'code' => 200,
                    'output' => view('home.product.type.fill',compact('detail_paras','customer','wishlist','id_type'))->render(),
                ]);
            }else{
                return response()->json([
                    'code' => 200,
                    'output' => view('home.product.type.fill',compact('detail_paras','id_type'))->render(),
                ]);
            }
        }else{
            $products = Product::where('sp_trangthai',1)->where('loaisp_id',$request->id_type)->get();
            if(isset($id_customer)) {
                $customer = Customer::find($id_customer);
                $wishlist = Wishlist::where('kh_id', $id_customer)->get();
                return response()->json([
                    'code' => 200,
                    'output' => view('home.product.type.fill-none',compact('products','customer','wishlist'))->render(),
                ]);
            }else{
                return response()->json([
                    'code' => 200,
                    'output' => view('home.product.type.fill-none',compact('products'))->render(),
                ]);
            }
        }
    }
}
