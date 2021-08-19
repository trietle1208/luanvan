<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Session;

class SlideController extends Controller
{
    use StorageImageTrait;
    private $slide;
    public function __construct(Slide $slide) {
        $this->slide = $slide;
    }
    public function index() {
        $slides= $this->slide->latest()->paginate(10);
        return view('admin.manager.slide.index', compact('slides',));
    }

    public function create() {
        return view('admin.manager.slide.create');
    }

    public function store(Request $request) {
        $dataCreate = [
            'sl_ten' => $request->name,
            'sl_mota' => $request->desc,
        ];
        $dataUpload = $this->storageTraitUpload($request, 'image', 'slide');
        if(!empty($dataUpload)) {
            $dataCreate['sl_hinhanh'] = $dataUpload['file_path'];
        }

        $this->slide->create($dataCreate);

        Session::put('message','Thêm Slide thành công !!!');
        return redirect()->route('admin.slide.create');
    }

    public function edit($id) {
        $slide = $this->slide->find($id);

        return view('admin.manager.slide.edit', compact('slide'));
    }

    public function update($id, Request $request) {
        $dataUpdate = [
            'sl_ten' => $request->name,
            'sl_mota' => $request->desc,
        ];
        $dataUpload = $this->storageTraitUpload($request, 'image', 'slide');
        if(!empty($dataUpload)) {
            $dataUpdate['sl_hinhanh'] = $dataUpload['file_path'];
        }

        $this->slide->find($id)->update($dataUpdate);
        Session::put('message','Cập nhật Slide thành công !!!');
        return redirect()->route('admin.slide.list');
    }

    public function delete($id) {
        $this->slide->find($id)->delete();

        Session::put('message','Xóa Slide thành công !!!');
        return redirect()->route('admin.slide.list');
    }
}
