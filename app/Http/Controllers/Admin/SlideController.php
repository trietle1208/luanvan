<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SlideAdd;
use App\Models\Slide;
use App\Traits\StorageImageTrait;
use Brian2694\Toastr\Facades\Toastr;
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

    public function store(SlideAdd $request) {
        $dataCreate = [
            'sl_ten' => $request->sl_ten,
            'sl_mota' => $request->desc,
        ];
        $dataUpload = $this->storageTraitUpload($request, 'image', 'slide');
        if(!empty($dataUpload)) {
            $dataCreate['sl_hinhanh'] = $dataUpload['file_path'];
        }

        $this->slide->create($dataCreate);

        Toastr::success('Thêm Slide thành công!','Thành công');
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
        Toastr::success('Cập nhật Slide thành công!','Thành công');
        return redirect()->route('admin.slide.list');
    }
    public function checkName(Request $request) {
        if($request->name) {
            $check = 0;
            $slide = $this->slide->where('sl_ten',$request->name)->get();
            if(count($slide) > 0) {
                $check = 1;
            }
            return response()->json($check);
        }
    }
    public function delete($id) {
        $this->slide->find($id)->delete();
        return response()->json([
            'code' => 200,
            'message' => 'success',
        ],200);
    }
}
