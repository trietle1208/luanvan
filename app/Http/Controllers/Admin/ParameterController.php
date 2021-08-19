<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Parameter;
use App\Models\TypeProduct;
use Session;

class ParameterController extends Controller
{
    private $para;
    private $type;
    private $htmlSelect = '';
    public function __construct(Parameter $para,TypeProduct $type) {
        $this->para = $para;
        $this->type = $type;

    }
    public function index() {
        $parameters = $this->para->latest()->paginate(10);
        return view('admin.manager.para.index', compact('parameters'));
    }

    public function create() {
        $types = $this->type->all();
        return view('admin.manager.para.create', compact('types'));
    }

    public function store(Request $request) {
        $this->para->create([
            'ts_tenthongso' => $request->name,
            'loaisp_id' => $request->parent,
        ]);

        Session::put('message','Thêm thông số thành công !!!');
        return redirect()->route('admin.para.create');
    }

    public function edit($id) {
        $parameters = $this->para->find($id);
        $types = $this->type->all();
        foreach ($types as $type) {
            if($type->loaisp_id == $parameters->typeproduct->loaisp_id) {
                $this->htmlSelect .= "<option selected value='". $type['loaisp_id']."'>" . $type->loaisp_ten ."</option>";
            }
            else {
                $this->htmlSelect .= "<option value='". $type['loaisp_id']."'>" . $type->loaisp_ten ."</option>";
            }
        }

        $htmlOption = $this->htmlSelect;
        return view('admin.manager.para.edit', compact('parameters','htmlOption'));
    }

    public function update($id, Request $request) {
        $this->para->find($id)->update([
            'ts_tenthongso' => $request->name,
            'loaisp_id' => $request->parent,
        ]);

        Session::put('message','Cập nhật thông số thành công !!!');
        return redirect()->route('admin.para.list');
    }

    public function delete($id) {
        $this->para->find($id)->delete();

        Session::put('message','Xóa thông số thành công !!!');
        return redirect()->route('admin.para.list');
    }

}
