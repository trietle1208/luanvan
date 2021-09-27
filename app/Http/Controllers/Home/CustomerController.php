<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Brand;
use App\Models\Customer;
use App\Models\DanhMuc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
class CustomerController extends Controller
{
    public function index() {
        $categories = DanhMuc::all();
        $brands = Brand::all();
        return view('home.customer.index', compact('categories','brands'));
    }

    public function register(Request $request) {
        $data = [
            'kh_hovaten' => $request->name,
            'kh_email' => $request->email,
            'kh_matkhau' => md5($request->pass),
            'kh_sdt' => $request->phone,
            'kh_ngaysinh' => $request->date,
            'kh_gioitinh' => $request->sex,
        ];

        $customer = DB::table('khachhang')->insertGetId($data);

        Session::put('customer_id',$customer);
        Session::put('customer_name',$request->name);

        return redirect()->route('customer.index');
    }

    public function login(Request $request) {
        $customer = Customer::where('kh_email',$request->name)->where('kh_matkhau',md5($request->password))->first();
        if($customer) {
            Session::put('customer_id',$customer->kh_id);
            Session::put('customer_name',$customer->kh_hovaten);
            return redirect()->route('checkout.index');
        }else{
            Session::put('message','Sai tên tài khoản hoặc mật khẩu');
            return redirect()->route('customer.index');
        }
    }

    public function logout() {
        Session::forget('customer_id');
        Session::forget('customer_name');
        return redirect()->route('trangchu');
    }

    public function profile() {
        $id = Session::get('customer_id');
        if($id) {
            $user = Customer::findOrFail($id);
            $address = $user->address->first();
            $add = Address::where('kh_id',$id)->get();
            return view('home.customer.profile',compact('user','address','add'));
        }

    }
}
