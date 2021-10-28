<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ParaAdd;
use Illuminate\Http\Request;
use App\Models\Parameter;
use App\Models\TypeProduct;
use Brian2694\Toastr\Facades\Toastr;
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
        $types = $this->type->all();
        return view('admin.manager.para.index', compact('types'));
    }

    public function create() {
        $types = $this->type->all();
        return view('admin.manager.para.create', compact('types'));
    }

    public function store(ParaAdd $request) {
        $this->para->create([
            'ts_tenthongso' => $request->name,
            'loaisp_id' => $request->parent,
        ]);

        Toastr::success('Thêm thông số thành công!','Thành công');
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

        Toastr::success('Cập nhật thông số thành công!','Thành công');
        return redirect()->route('admin.para.list');
    }

    public function delete($id) {
        $this->para->find($id)->delete();
        return response()->json([
            'code' => 200,
            'message' => 'success',
        ], 200);
    }

    public function modalAjax(Request $request) {
        $paras = $this->para->where('loaisp_id',$request->id)->get();
        $type = $this->type->find($request->id);
        return view('admin.manager.type.chitiet',compact('paras','type'))->render();
    }
}
