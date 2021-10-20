<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CatePostsAdd;
use App\Models\CatePosts;
use Illuminate\Http\Request;
use Session;
class CatePostsController extends Controller
{
    public function index(){
        $categories = CatePosts::all();
        return view('admin.manager.cate_posts.index',compact('categories'));
    }

    public function create(){
        return view('admin.manager.cate_posts.create');
    }

    public function store(CatePostsAdd $request){
        CatePosts::create([
            'dmbv_ten' => $request->dm_ten,
            'dmbv_mota' => $request->desc,
            'dmbv_slug' => str_slug($request->dm_ten),
        ]);

        Session::put('message','Thêm danh mục bài viết thành công !!!');
        return redirect()->route('admin.cate_posts.create');
    }

    public function edit($id) {
        $category = CatePosts::find($id);

        return view('admin.manager.cate_posts.edit', compact('category'));
    }

    public function update($id, CatePostsAdd $request) {
        CatePosts::find($id)->update([
            'dmbv_ten' => $request->dm_ten,
            'dmbv_mota' => $request->desc,
            'dmbv_slug' => str_slug($request->dm_ten),
        ]);

        return redirect()->route('admin.cate_posts.list');
    }
}
