<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DanhMuc;
use App\Component\Recusive;
use Session;

class CategoryController extends Controller
{
    private $category;
    public function __construct(DanhMuc $category) {
        $this->category = $category;
    }
    public function index() {
        $categories = $this->category->latest()->paginate(3);
        $category_parent = $this->category->where('dm_idcha',0)->get();
        return view('admin.manager.cate.index', compact('categories','category_parent'));
    }

    public function create() {
        $htmlOption = $this->getCategory($parentId = '');
        return view('admin.manager.cate.create', compact('htmlOption'));
    }

    public function store(Request $request) {
        $this->category->create([
           'dm_ten' => $request->name,
           'dm_idcha' => $request->parent,
           'dm_mota' => $request->desc,
           'dm_slug' => str_slug($request->name),
        ]);

        Session::put('message','Thêm danh mục thành công !!!');
        return redirect()->route('admin.cate.create');
    }
    public function getCategory($parentId) {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecusise($parentId);

        return $htmlOption;
    }
    public function edit($id) {
        $category = $this->category->find($id);
        $htmlOption = $this->getCategory($category->dm_idcha);

        return view('admin.manager.cate.edit', compact('category','htmlOption'));
    }

    public function update($id, Request $request) {
        $this->category->find($id)->update([
            'dm_ten' => $request->name,
            'dm_idcha' => $request->parent,
            'dm_mota' => $request->desc,
            'dm_slug' => str_slug($request->name),
        ]);

        return redirect()->route('admin.cate.list');
    }
    public function delete($id) {
        $this->category->find($id)->delete();

        return redirect()->route('admin.cate.list');
    }

    public function hasDelete() {
        $categories = $this->category->where('deleted_at','<>',NULL)->get();
        dd($categories);
        $category_parent = $this->category->where('dm_idcha',0)->get();
        return view('admin.manager.cate.delete', compact('categories','category_parent'));
    }
}
