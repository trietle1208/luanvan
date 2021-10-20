<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostsAdd;
use App\Http\Requests\ProductAdd;
use App\Models\CatePosts;
use App\Models\Posts;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Session;
class PostsController extends Controller
{
    use StorageImageTrait;
    public function index() {
        $cateposts = CatePosts::all();
        $posts = Posts::all();
        return view('admin.manager.posts.index',compact('cateposts','posts'));
    }

    public function create(){
        $cateposts = CatePosts::all();

        return view('admin.manager.posts.create',compact('cateposts'));
    }

    public function store(PostsAdd $request){
        $dataUpload = $this->storageTraitUpload($request, 'image', 'posts');
        Posts::create([
            'dmbv_id' => $request->parent,
            'bv_ten' => $request->bv_ten ,
            'bv_tomtat' => $request->desc,
            'bv_noidung' => $request->contentpost,
            'bv_hinhanh' => $dataUpload['file_path'],
            'bv_slug' => str_slug($request->bv_ten),
        ]);

        Session::put('message','Thêm bài viết thành công !!!');
        return redirect()->route('admin.posts.create');
    }

    public function edit($id){
        $cateposts = CatePosts::all();
        $post = Posts::find($id);

        return view('admin.manager.posts.edit',compact('cateposts','post'));
    }

    public function update($id, PostsAdd $request){
        $dataUpload = $this->storageTraitUpload($request, 'image', 'posts');
        Posts::find($id)->update([
            'dmbv_id' => $request->parent,
            'bv_ten' => $request->bv_ten ,
            'bv_tomtat' => $request->desc,
            'bv_noidung' => $request->contentpost,
            'bv_hinhanh' => $dataUpload['file_path'],
            'bv_slug' => str_slug($request->bv_ten),
        ]);

        Session::put('message','Cập nhật bài viết thành công !!!');
        return redirect()->route('admin.posts.list');
    }
}
