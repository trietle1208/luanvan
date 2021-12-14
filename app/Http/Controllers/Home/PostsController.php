<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\CatePosts;
use App\Models\Customer;
use App\Models\DanhMuc;
use App\Models\Posts;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostsController extends Controller
{
    public function index(Request $request,$slug){
        $url = $request->url();
        $id_customer = Session::get('customer_id');
        $customer = Customer::find($id_customer);
        $wishlist = Wishlist::where('kh_id',$id_customer)->get();
        $count_wistlist = $wishlist->count();
        $cateposts = CatePosts::all();
        $posts = CatePosts::where('dmbv_slug',$slug)->first();
        $categories = DanhMuc::all();
        $brands = Brand::all();
        return view('home.posts.index',compact('url','count_wistlist','cateposts','categories','brands','posts'));
    }

    public function showPosts(Request $request){
        $posts = Posts::find($request->id);
        return response()->json([
           'code' => 200,
            'output' => view('home.posts.posts',compact('posts'))->render(),
        ],200);
    }
}
