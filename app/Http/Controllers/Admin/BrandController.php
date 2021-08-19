<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Traits\StorageImageTrait;
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

    public function store(Request $request) {
        $dataCreate = [
            'th_ten' => $request->name,
            'th_mota' => $request->desc,
            'th_slug' => str_slug($request->name),
        ];
        $dataUpload = $this->storageTraitUpload($request, 'image', 'brand');
        if(!empty($dataUpload)) {
            $dataCreate['th_hinhanh'] = $dataUpload['file_path'];
        }

        $this->brand->create($dataCreate);

        Session::put('message','Thêm thương hiệu thành công !!!');
        return redirect()->route('admin.brand.create');
    }

    public function edit($id) {
        $brand = $this->brand->find($id);

        return view('admin.manager.brand.edit', compact('brand'));
    }

    public function update($id, Request $request) {
        $dataUpdate = [
            'th_ten' => $request->name,
            'th_mota' => $request->desc,
            'th_slug' => str_slug($request->name),
        ];
        $dataUpload = $this->storageTraitUpload($request, 'image', 'brand');
        if(!empty($dataUpload)) {
            $dataUpdate['th_hinhanh'] = $dataUpload['file_path'];
        }

        $this->brand->find($id)->update($dataUpdate);
        Session::put('message','Cập nhật thương hiệu thành công !!!');
        return redirect()->route('admin.brand.list');
    }

    public function delete($id) {
        $this->brand->find($id)->delete();

        Session::put('message','Xóa thương hiệu thành công !!!');
        return redirect()->route('admin.brand.list');
    }
}