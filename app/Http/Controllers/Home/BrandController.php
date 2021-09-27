<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\DanhMuc;
use App\Models\Product;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index($slug, $id) {
        $categories = DanhMuc::all();
        $brands = Brand::all();
        $products = Product::where('sp_trangthai',1)->where('th_id',$id)->paginate(12);
        return view('home.product.brand.list',compact('categories','brands','products'));
    }
}
