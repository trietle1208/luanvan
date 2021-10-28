<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandAdd;
use App\Models\Brand;
use App\Traits\StorageImageTrait;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Session;

class BrandController extends Controller
{
    use StorageImageTrait;
    private $brand;
    public function __construct(Brand $brand) {
        $this->brand = $brand;
    }
    public function index() {
        $brands= $this->brand->latest()->paginate(10);
        return view('admin.manager.brand.index', compact('brands',));
    }

    public function create() {
        return view('admin.manager.brand.create');
    }

    public function store(BrandAdd $request) {
        $dataCreate = [
            'th_ten' => $request->th_ten,
            'th_mota' => $request->desc,
            'th_slug' => str_slug($request->th_ten),
        ];
        $dataUpload = $this->storageTraitUpload($request, 'image', 'brand');
        if(!empty($dataUpload)) {
            $dataCreate['th_hinhanh'] = $dataUpload['file_path'];
        }

        $this->brand->create($dataCreate);

        Toastr::success('Thêm thương hiệu thành công!','Thành công');
        return redirect()->route('admin.brand.create');
    }

    public function edit($id) {
        $brand = $this->brand->find($id);

        return view('admin.manager.brand.edit', compact('brand'));
    }

    public function update($id, BrandAdd $request) {
        $dataUpdate = [
            'th_ten' => $request->th_ten,
            'th_mota' => $request->desc,
            'th_slug' => str_slug($request->th_ten),
        ];
        $dataUpload = $this->storageTraitUpload($request, 'image', 'brand');
        if(!empty($dataUpload)) {
            $dataUpdate['th_hinhanh'] = $dataUpload['file_path'];
        }

        $this->brand->find($id)->update($dataUpdate);
        Toastr::success('Cập thương hiệu danh mục thành công!','Thành công');
        return redirect()->route('admin.brand.list');
    }

    public function checkName(Request $request) {
        if($request->name) {
            $check = 0;
            $brand = $this->brand->where('th_ten',$request->name)->get();
            if(count($brand) > 0) {
                $check = 1;
            }
            return response()->json($check);
        }
    }
    public function delete($id) {
        $this->brand->find($id)->delete();
        return response()->json([
            'code' => 200,
            'message' => 'success',
        ],200);
    }


}
