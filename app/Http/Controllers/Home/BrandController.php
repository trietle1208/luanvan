<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\CatePosts;
use App\Models\Customer;
use App\Models\DanhMuc;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BrandController extends Controller
{
    public function index($slug, $id) {
        $cateposts = CatePosts::all();
        $categories = DanhMuc::all();
        $brands = Brand::all();
        $products = Product::where('sp_trangthai',1)->where('th_id',$id)->paginate(12);
        $id_customer = Session::get('customer_id');
        if(isset($id_customer)) {
            $customer = Customer::find($id_customer);
            $wishlist = Wishlist::where('kh_id',$id_customer)->get();
            $count_wistlist = $wishlist->count();
            return view('home.product.brand.list',compact('count_wistlist','categories','brands','products','wishlist','customer','cateposts'));
        }else{
            return view('home.product.brand.list',compact('categories','brands','products','cateposts'));
        }
    }
}
