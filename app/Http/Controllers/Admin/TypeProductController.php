<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TypeProduct;
use Illuminate\Http\Request;
use Session;

class TypeProductController extends Controller
{
    private $type;
    public function __construct(TypeProduct $type) {
        $this->type = $type;
    }
    public function index() {
        $types = $this->type->latest()->paginate(10);

        return view('admin.manager.type.index', compact('types'));
    }

    public function create() {
        return view('admin.manager.type.create');
    }

    public function store(Request $request) {
        $this->type->create([
            'loaisp_ten' => $request->name,
            'loaisp_mota' => $request->desc,
            'loaisp_slug' => str_slug($request->name),
        ]);

        Session::put('message','Thêm loại thành công !!!');
        return redirect()->route('admin.type.create');
    }

    public function edit($id) {
        $type = $this->type->find($id);


        return view('admin.manager.type.edit', compact('type'));
    }

    public function update($id, Request $request) {
        $this->type->find($id)->update([
            'loaisp_ten' => $request->name,
            'loaisp_mota' => $request->desc,
            'dm_slug' => str_slug($request->name),
        ]);
        Session::put('message','Cập nhật loại thành công !!!');
        return redirect()->route('admin.type.list');
    }
    public function delete($id) {
        $this->type->find($id)->delete();
        Session::put('message','Xóa loại thành công !!!');
        return redirect()->route('admin.type.list');
    }
}
