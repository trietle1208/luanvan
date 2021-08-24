<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryAdd;
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
        $categories = $this->category->latest()->paginate(5);
        $category_parent = $this->category->where('dm_idcha',0)->get();
        return view('admin.manager.cate.index', compact('categories','category_parent'));
    }

    public function create() {
        $htmlOption = $this->getCategory($parentId = '');
        return view('admin.manager.cate.create', compact('htmlOption'));
    }

    public function store(CategoryAdd $request) {
        $this->category->create([
           'dm_ten' => $request->dm_ten,
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

    public function update($id, CategoryAdd $request) {
        $this->category->find($id)->update([
            'dm_ten' => $request->dm_ten,
            'dm_idcha' => $request->parent,
            'dm_mota' => $request->desc,
            'dm_slug' => str_slug($request->dm_ten),
        ]);

        return redirect()->route('admin.cate.list');
    }
    public function delete($id) {
        $this->category->find($id)->delete();
        return response()->json([
            'code' => 200,
            'message' => 'success',
        ], 200);
    }

    public function hasDelete() {
        $categories = $this->category->where('deleted_at','<>',NULL)->get();
        dd($categories);
        $category_parent = $this->category->where('dm_idcha',0)->get();
        return view('admin.manager.cate.delete', compact('categories','category_parent'));
    }

    public function checkName(Request $request) {
        if($request->name) {
            $check = 0;
            $category = $this->category->where('dm_ten',$request->name)->get();
            if(count($category) > 0) {
                $check = 1;
            }
            return response()->json($check);
        }
    }
}
