<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TypeAdd;
use App\Models\DanhMuc;
use App\Models\TypeProduct;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Session;

class TypeProductController extends Controller
{
    private $type;
    public function __construct(TypeProduct $type, DanhMuc $category) {
        $this->type = $type;
        $this->category = $category;
    }
    public function index() {
        $types = $this->type->latest()->get();

        return view('admin.manager.type.index', compact('types'));
    }

    public function create() {
        $categories = $this->category->all();
        return view('admin.manager.type.create', compact('categories'));
    }

    public function store(TypeAdd $request) {
        $this->type->create([
            'loaisp_ten' => $request->loaisp_ten,
            'loaisp_mota' => $request->desc,
            'dm_id' => $request->parent,
            'loaisp_slug' => str_slug($request->loaisp_ten),
        ]);

        Toastr::success('Thêm loại thành công!','Thành công');
        return redirect()->route('admin.type.create');
    }

    public function edit($id) {
        $type = $this->type->find($id);
        $categories = $this->category->all();
        return view('admin.manager.type.edit', compact('type','categories'));
    }

    public function update($id, Request $request) {
        $this->type->find($id)->update([
            'loaisp_ten' => $request->name,
            'loaisp_mota' => $request->desc,
            'dm_id' => $request->parent,
            'dm_slug' => str_slug($request->name),
        ]);
        Toastr::success('Cập nhật loại thành công!','Thành công');
        return redirect()->route('admin.type.list');
    }
    public function checkName(Request $request) {
        if($request->name) {
            $check = 0;
            $type = $this->type->where('loaisp_ten',$request->name)->get();
            if(count($type) > 0) {
                $check = 1;
            }
            return response()->json($check);
        }
    }
    public function delete($id) {
        $this->type->find($id)->delete();
        return response()->json([
            'code' => 200,
            'message' => 'success',
        ], 200);
    }
}
