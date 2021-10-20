<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\CatePosts;
use App\Models\Customer;
use App\Models\DanhMuc;
use App\Models\Discount;
use App\Models\Product;
use App\Models\Receipt;
use App\Models\ReceiptDetail;
use App\Models\Slide;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index() {
        $cateposts = CatePosts::all();
        $sliders = Slide::all();
        $categories = DanhMuc::all();
        $brands = Brand::all();
        $products = Product::where('sp_trangthai',1)->latest()->get();
        $product_rating = Product::where('sp_trangthai',1)->withAvg('comment','bl_sosao')->orderBy('comment_avg_bl_sosao','DESC')->take(6)->get();
        $max = Product::where('sp_trangthai',1)->min('sp_giabanra');
        $min = Product::where('sp_trangthai',1)->max('sp_giabanra');
        $id_customer = Session::get('customer_id');
        if(isset($id_customer)){
            $customer = Customer::find($id_customer);
            $wishlist = Wishlist::where('kh_id',$id_customer)->get();
            return view('home.home',compact('sliders','categories','brands','products','wishlist','customer','max','min','cateposts','product_rating'));
        }else{
            return view('home.home',compact('sliders','categories','brands','products','max','min','cateposts','product_rating'));
        }

    }

    public function search(Request $request){
        $key_word = $request->name;
        $sliders = Slide::all();
        $categories = DanhMuc::all();
        $brands = Brand::all();
        $products = Product::where('sp_ten','like','%'.$key_word.'%')->get();
        return view('home.components.search',compact('sliders','categories','brands','products'));
    }

    public function loadProduct(Request $request){
        if($request->id > 0){
            $products = Product::where('sp_trangthai',1)->where('sp_id','<',$request->id)->latest()->take(6)->get();
            foreach ($products as $product){
                $last_id = $product->sp_id;
            }
        }else{
            $products = Product::where('sp_trangthai',1)->latest()->take(6)->get();
            foreach ($products as $product){
                $last_id = $product->sp_id;
            }
        }
        if(!$products->isEmpty()){
            $id_customer = Session::get('customer_id');
            if(isset($id_customer)){
                $customer = Customer::find($id_customer);
                $wishlist = Wishlist::where('kh_id',$id_customer)->get();
                return response()->json([
                    'code' => 300,
                    'output2' => view('home.components.load_product',compact('products','customer','wishlist'))->render(),
                    'button2' => view('home.components.button',compact('last_id'))->render(),
                ]);
            }else{
                return response()->json([
                    'code' => 200,
                    'output' => view('home.components.load_product',compact('products'))->render(),
                    'button' => view('home.components.button',compact('last_id'))->render(),
                ]);
            }

        }else{
            return response()->json([
                'code' => 400,
                'output2' => '<button type="button" class="btn btn-danger form-control">
                                Đã hiện thị tất cả sản phẩm
                             </button>',
            ]);
        }
    }

    public function fillterPrice(Request $request){
        $products = Product::whereBetween('sp_giabanra',[$request->start ,$request->end])->where('sp_trangthai',1)->get();
        if(!empty($products)){
            $customer_id = Session::get('customer_id');
            if(isset($customer_id)){
                $customer = Customer::find($customer_id);
                $wishlist = Wishlist::where('kh_id',$customer_id)->get();
                return response()->json([
                    'code' => 200,
                    'output' => view('home.components.fillter_price',compact('products','customer','wishlist'))->render(),
                ]);
            }
            else
            {
                return response()->json([
                    'code' => 200,
                    'output' => view('home.components.fillter_price',compact('products'))->render(),
                ]);
            }

        }else{
            return response()->json([
                'code' => 400,
                'none' => '<strong class="text-center">Không tìm thấy sản phẩm theo yêu cầu!</strong>',
            ]);
        }
    }

    public function fillterRating(Request $request) {
        $products = Product::all();
        $product_rating = array();
        foreach ($products as $product) {
            if((int)$product->comment()->avg('bl_sosao') == $request->rating){
                array_push($product_rating,$product);
            }else{
                continue;
            }
        }
        if(!empty($product_rating)){
            $customer_id = Session::get('customer_id');
            if(isset($customer_id)){
                $customer = Customer::find($customer_id);
                $wishlist = Wishlist::where('kh_id',$customer_id)->get();
                return response()->json([
                    'code' => 200,
                    'output' => view('home.components.fillter_rating',compact('product_rating','customer','wishlist'))->render(),
                ]);
            }
            else
            {
                return response()->json([
                    'code' => 200,
                    'output' => view('home.components.fillter_rating',compact('product_rating'))->render(),
                ]);
            }

        }else{
            return response()->json([
                'code' => 400,
                'none' => '<strong class="text-center">Không tìm thấy sản phẩm theo yêu cầu!</strong>',
            ]);
        }
    }

    public function fillterSort(Request $request){
        if($request->cate == null && $request->brand == null){
            if($request->type == 1){
                $products = Product::where('sp_trangthai',1)->orderBy('sp_ten','ASC')->get();
                $customer_id = Session::get('customer_id');
                if(isset($customer_id)){
                    $customer = Customer::find($customer_id);
                    $wishlist = Wishlist::where('kh_id',$customer_id)->get();
                    return response()->json([
                        'code' => 200,
                        'output' => view('home.components.fillter_sort',compact('products','customer','wishlist'))->render(),
                    ]);
                }
                else
                {
                    return response()->json([
                        'code' => 200,
                        'output' => view('home.components.fillter_sort',compact('products'))->render(),
                    ]);
                }
            }elseif ($request->type == 2){
                $products = Product::where('sp_trangthai',1)->orderBy('sp_ten','DESC')->get();
                $customer_id = Session::get('customer_id');
                if(isset($customer_id)){
                    $customer = Customer::find($customer_id);
                    $wishlist = Wishlist::where('kh_id',$customer_id)->get();
                    return response()->json([
                        'code' => 200,
                        'output' => view('home.components.fillter_sort',compact('products','customer','wishlist'))->render(),
                    ]);
                }
                else
                {
                    return response()->json([
                        'code' => 200,
                        'output' => view('home.components.fillter_sort',compact('products'))->render(),
                    ]);
                }
            }elseif ($request->type == 3){
                $products = Product::where('sp_trangthai',1)->orderBy('sp_giabanra','ASC')->get();
                $customer_id = Session::get('customer_id');
                if(isset($customer_id)){
                    $customer = Customer::find($customer_id);
                    $wishlist = Wishlist::where('kh_id',$customer_id)->get();
                    return response()->json([
                        'code' => 200,
                        'output' => view('home.components.fillter_sort',compact('products','customer','wishlist'))->render(),
                    ]);
                }
                else
                {
                    return response()->json([
                        'code' => 200,
                        'output' => view('home.components.fillter_sort',compact('products'))->render(),
                    ]);
                }
            }else{
                $products = Product::where('sp_trangthai',1)->orderBy('sp_giabanra','DESC')->get();
                $customer_id = Session::get('customer_id');
                if(isset($customer_id)){
                    $customer = Customer::find($customer_id);
                    $wishlist = Wishlist::where('kh_id',$customer_id)->get();
                    return response()->json([
                        'code' => 200,
                        'output' => view('home.components.fillter_sort',compact('products','customer','wishlist'))->render(),
                    ]);
                }
                else
                {
                    return response()->json([
                        'code' => 200,
                        'output' => view('home.components.fillter_sort',compact('products'))->render(),
                    ]);
                }
            }
        }
        elseif($request->cate != null && $request->brand == null)
        {
            if($request->type == 1){
                $products = Product::where('sp_trangthai',1)->where('dm_id',$request->cate)->orderBy('sp_ten','ASC')->get();
                $customer_id = Session::get('customer_id');
                if(isset($customer_id)){
                    $customer = Customer::find($customer_id);
                    $wishlist = Wishlist::where('kh_id',$customer_id)->get();
                    return response()->json([
                        'code' => 200,
                        'output' => view('home.components.fillter_sort',compact('products','customer','wishlist'))->render(),
                    ]);
                }
                else
                {
                    return response()->json([
                        'code' => 200,
                        'output' => view('home.components.fillter_sort',compact('products'))->render(),
                    ]);
                }
            }elseif ($request->type == 2){
                $products = Product::where('sp_trangthai',1)->where('dm_id',$request->cate)->orderBy('sp_ten','DESC')->get();
                $customer_id = Session::get('customer_id');
                if(isset($customer_id)){
                    $customer = Customer::find($customer_id);
                    $wishlist = Wishlist::where('kh_id',$customer_id)->get();
                    return response()->json([
                        'code' => 200,
                        'output' => view('home.components.fillter_sort',compact('products','customer','wishlist'))->render(),
                    ]);
                }
                else
                {
                    return response()->json([
                        'code' => 200,
                        'output' => view('home.components.fillter_sort',compact('products'))->render(),
                    ]);
                }
            }elseif ($request->type == 3){
                $products = Product::where('sp_trangthai',1)->where('dm_id',$request->cate)->orderBy('sp_giabanra','ASC')->get();
                $customer_id = Session::get('customer_id');
                if(isset($customer_id)){
                    $customer = Customer::find($customer_id);
                    $wishlist = Wishlist::where('kh_id',$customer_id)->get();
                    return response()->json([
                        'code' => 200,
                        'output' => view('home.components.fillter_sort',compact('products','customer','wishlist'))->render(),
                    ]);
                }
                else
                {
                    return response()->json([
                        'code' => 200,
                        'output' => view('home.components.fillter_sort',compact('products'))->render(),
                    ]);
                }
            }else{
                $products = Product::where('sp_trangthai',1)->where('dm_id',$request->cate)->orderBy('sp_giabanra','DESC')->get();
                $customer_id = Session::get('customer_id');
                if(isset($customer_id)){
                    $customer = Customer::find($customer_id);
                    $wishlist = Wishlist::where('kh_id',$customer_id)->get();
                    return response()->json([
                        'code' => 200,
                        'output' => view('home.components.fillter_sort',compact('products','customer','wishlist'))->render(),
                    ]);
                }
                else
                {
                    return response()->json([
                        'code' => 200,
                        'output' => view('home.components.fillter_sort',compact('products'))->render(),
                    ]);
                }
            }
        }
        else if($request->brand != null && $request->cate == null)
        {
            if($request->type == 1){
                $products = Product::where('sp_trangthai',1)->where('th_id',$request->brand)->orderBy('sp_ten','ASC')->get();
                $customer_id = Session::get('customer_id');
                if(isset($customer_id)){
                    $customer = Customer::find($customer_id);
                    $wishlist = Wishlist::where('kh_id',$customer_id)->get();
                    return response()->json([
                        'code' => 200,
                        'output' => view('home.components.fillter_sort',compact('products','customer','wishlist'))->render(),
                    ]);
                }
                else
                {
                    return response()->json([
                        'code' => 200,
                        'output' => view('home.components.fillter_sort',compact('products'))->render(),
                    ]);
                }
            }elseif ($request->type == 2){
                $products = Product::where('sp_trangthai',1)->where('th_id',$request->brand)->orderBy('sp_ten','DESC')->get();
                $customer_id = Session::get('customer_id');
                if(isset($customer_id)){
                    $customer = Customer::find($customer_id);
                    $wishlist = Wishlist::where('kh_id',$customer_id)->get();
                    return response()->json([
                        'code' => 200,
                        'output' => view('home.components.fillter_sort',compact('products','customer','wishlist'))->render(),
                    ]);
                }
                else
                {
                    return response()->json([
                        'code' => 200,
                        'output' => view('home.components.fillter_sort',compact('products'))->render(),
                    ]);
                }
            }elseif ($request->type == 3){
                $products = Product::where('sp_trangthai',1)->where('th_id',$request->brand)->orderBy('sp_giabanra','ASC')->get();
                $customer_id = Session::get('customer_id');
                if(isset($customer_id)){
                    $customer = Customer::find($customer_id);
                    $wishlist = Wishlist::where('kh_id',$customer_id)->get();
                    return response()->json([
                        'code' => 200,
                        'output' => view('home.components.fillter_sort',compact('products','customer','wishlist'))->render(),
                    ]);
                }
                else
                {
                    return response()->json([
                        'code' => 200,
                        'output' => view('home.components.fillter_sort',compact('products'))->render(),
                    ]);
                }
            }else{
                $products = Product::where('sp_trangthai',1)->where('th_id',$request->brand)->orderBy('sp_giabanra','DESC')->get();
                $customer_id = Session::get('customer_id');
                if(isset($customer_id)){
                    $customer = Customer::find($customer_id);
                    $wishlist = Wishlist::where('kh_id',$customer_id)->get();
                    return response()->json([
                        'code' => 200,
                        'output' => view('home.components.fillter_sort',compact('products','customer','wishlist'))->render(),
                    ]);
                }
                else
                {
                    return response()->json([
                        'code' => 200,
                        'output' => view('home.components.fillter_sort',compact('products'))->render(),
                    ]);
                }
            }
        }
        else
        {
            if($request->type == 1){
                $products = Product::where('sp_trangthai',1)->where('th_id',$request->brand)->where('dm_id',$request->cate)->orderBy('sp_ten','ASC')->get();
                $customer_id = Session::get('customer_id');
                if(isset($customer_id)){
                    $customer = Customer::find($customer_id);
                    $wishlist = Wishlist::where('kh_id',$customer_id)->get();
                    return response()->json([
                        'code' => 200,
                        'output' => view('home.components.fillter_sort',compact('products','customer','wishlist'))->render(),
                    ]);
                }
                else
                {
                    return response()->json([
                        'code' => 200,
                        'output' => view('home.components.fillter_sort',compact('products'))->render(),
                    ]);
                }
            }elseif ($request->type == 2){
                $products = Product::where('sp_trangthai',1)->where('th_id',$request->brand)->where('dm_id',$request->cate)->orderBy('sp_ten','DESC')->get();
                $customer_id = Session::get('customer_id');
                if(isset($customer_id)){
                    $customer = Customer::find($customer_id);
                    $wishlist = Wishlist::where('kh_id',$customer_id)->get();
                    return response()->json([
                        'code' => 200,
                        'output' => view('home.components.fillter_sort',compact('products','customer','wishlist'))->render(),
                    ]);
                }
                else
                {
                    return response()->json([
                        'code' => 200,
                        'output' => view('home.components.fillter_sort',compact('products'))->render(),
                    ]);
                }
            }elseif ($request->type == 3){
                $products = Product::where('sp_trangthai',1)->where('th_id',$request->brand)->where('dm_id',$request->cate)->orderBy('sp_giabanra','ASC')->get();
                $customer_id = Session::get('customer_id');
                if(isset($customer_id)){
                    $customer = Customer::find($customer_id);
                    $wishlist = Wishlist::where('kh_id',$customer_id)->get();
                    return response()->json([
                        'code' => 200,
                        'output' => view('home.components.fillter_sort',compact('products','customer','wishlist'))->render(),
                    ]);
                }
                else
                {
                    return response()->json([
                        'code' => 200,
                        'output' => view('home.components.fillter_sort',compact('products'))->render(),
                    ]);
                }
            }else{
                $products = Product::where('sp_trangthai',1)->where('th_id',$request->brand)->where('dm_id',$request->cate)->orderBy('sp_giabanra','DESC')->get();
                $customer_id = Session::get('customer_id');
                if(isset($customer_id)){
                    $customer = Customer::find($customer_id);
                    $wishlist = Wishlist::where('kh_id',$customer_id)->get();
                    return response()->json([
                        'code' => 200,
                        'output' => view('home.components.fillter_sort',compact('products','customer','wishlist'))->render(),
                    ]);
                }
                else
                {
                    return response()->json([
                        'code' => 200,
                        'output' => view('home.components.fillter_sort',compact('products'))->render(),
                    ]);
                }
            }
        }
    }
}
