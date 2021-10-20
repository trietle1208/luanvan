<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\CatePosts;
use App\Models\DanhMuc;
use App\Models\Posts;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index($slug){
        $cateposts = CatePosts::all();
        $posts = CatePosts::where('dmbv_slug',$slug)->first();
        $categories = DanhMuc::all();
        $brands = Brand::all();
        return view('home.posts.index',compact('cateposts','categories','brands','posts'));
    }

    public function showPosts(Request $request){
        $posts = Posts::find($request->id);
        return response()->json([
           'code' => 200,
            'output' => view('home.posts.posts',compact('posts'))->render(),
        ],200);
    }
}
