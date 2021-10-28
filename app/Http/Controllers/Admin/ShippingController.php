<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingAdd;
use App\Models\Shipping;
use App\Traits\StorageImageTrait;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Session;
class ShippingController extends Controller
{
    use StorageImageTrait;
    private $shipping;
    public function __construct(Shipping $shipping) {
        $this->shipping = $shipping;
    }
    public function index() {
        $ships = $this->shipping->all();
        return view('admin.manager.shipping.index',compact('ships'));

    }

    public function create() {
        return view('admin.manager.shipping.create');
    }

    public function store(ShippingAdd $request) {
        $dataCreate = [
            'ht_ten' => $request->name,

        ];
        $dataUpload = $this->storageTraitUpload($request, 'image', 'shipping');
        if(!empty($dataUpload)) {
            $dataCreate['ht_hinhanh'] = $dataUpload['file_path'];
        }

        $this->shipping->create($dataCreate);

        Toastr::success('Thêm hình thức thành công!','Thành công');
        return redirect()->route('admin.ship.create');
    }

    public function update() {

    }

    public function edit() {

    }

    public function delete() {

    }
}
