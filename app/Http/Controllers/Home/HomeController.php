<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\DanhMuc;
use App\Models\Discount;
use App\Models\Product;
use App\Models\Receipt;
use App\Models\ReceiptDetail;
use App\Models\Slide;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $sliders = Slide::all();
        $categories = DanhMuc::all();
        $brands = Brand::all();
        $products = Product::where('sp_trangthai',1)->where('dm_id',13)->latest()->take(6)->get();
        $discount = Discount::all();
        return view('home.home',compact('sliders','categories','brands','products','discount'));
    }

}
