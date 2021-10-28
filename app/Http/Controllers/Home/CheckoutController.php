<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Brand;
use App\Models\CatePosts;
use App\Models\City;
use App\Models\DanhMuc;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderNCC;
use App\Models\Province;
use App\Models\Shipping;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    public function index() {

        $subtotal = 0;
        $discount = 0;
        $total = 0;
        $carts = Session::get('cart');
        dd($carts);
        if($carts){
            foreach ($carts as $key => $cart) {
                foreach ($cart as $key => $product) {
                    if($key != 0) {
                        $subtotal += $product['total'];
                    }else
                        if(count($product) > 0){
                            $discount += $product['voucherPrice'];
                        }
                }
            }
            $cateposts = CatePosts::all();   
            $shipping = Shipping::orderBy('ht_id','DESC')->get();
            $city = City::orderBy('tp_id','ASC')->get();
            $address = Address::where('kh_id',Session::get('customer_id'))->orderBy('dc_id','DESC')->get();
            $fee_ship = $address[0]->ward->province->city->phivanchuyen;
            $total = $subtotal - $discount + $fee_ship;
            return view('home.product.cart.checkout',compact('total','shipping','city','address','carts','subtotal','total','discount','cateposts','fee_ship'));
        }else{
            $cateposts = CatePosts::all();
            $shipping = Shipping::orderBy('ht_id','DESC')->get();
            $city = City::orderBy('tp_id','ASC')->get();
            $address = Address::where('kh_id',Session::get('customer_id'))->orderBy('dc_id','DESC')->get();
            return view('home.product.cart.checkout',compact('shipping','city','address','cateposts'));
        }
    }
    public function selectAdd(Request $request) {
        $output = '';
        if($request->attr == 'city') {
            $select_province = Province::where('tp_id',(int)$request->id)->orderBy('qh_id','ASC')->get();
            foreach ($select_province as $key => $province) {
                $output .= '<option value="'.$province->qh_id.'">'.$province->qh_ten.'</option>';
            }
        }else{
            $select_ward = Ward::where('qh_id',(int)$request->id)->orderBy('xp_id','ASC')->get();
            foreach ($select_ward as $key2 => $ward) {
                $output .= '<option value="'.$ward->xp_id.'">'.$ward->xp_ten.'</option>';
            }
        }
        echo $output;
    }

    public function saveAdd(Request $request) {
        $user = Session::get('customer_id');
        $output = '';
        if($request) {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'phone' => 'required|numeric',
                'address' => 'required',
                'province' => 'required',
                'city' => 'required',
                'ward' => 'required',
            ],[
                'name.required' => 'Vui lòng không để trống mục tên của tên người nhận.',
                'phone.required' => 'Vui lòng không để trống mục số điện thoại người nhận',
                'address.required' => 'Vui lòng không để trống mục địa chỉ của người nhận.',
                'ward.required' => 'Vui lòng chọn xã/phường.',
                'city.required' => 'Vui lòng chọn thành phố',
                'province.required' => 'Vui lòng chọn quận/huyện.',
                'phone.numeric' => 'Số điện thoại nhập vào phải là kí tự số.',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'code' => 400,
                    'errors' => $validator->errors()
                ]);
            }
            $data = Address::insertGetId([
                'dc_sonha' => $request->address,
                'dc_tennguoinhan' => $request->name,
                'dc_sdt' => $request->phone,
                'kh_id' => $user,
                'xp_id' => $request->ward,
            ]);
            $carts = Session::get('cart');
            $total = 0;
            $subtotal = 0;
            $discount = 0;
            foreach ($carts as $key => $cart) {
                foreach ($cart as $key => $product) {
                    if($key != 0) {
                        $subtotal += $product['total'];
                    }else
                        if(count($product) > 0){
                            $discount += $product['voucherPrice'];
                        }
                }
            }

            $address = Address::where('kh_id',$user)->orderBy('dc_id','DESC')->get();
            foreach ($address as $add){
                if($add->dc_id == $data) {
                    $output .= '<div class="chooseAddress">
                                    <input type="radio" name="address" checked>
                                    <span class="labelAddress">'.$add->dc_sonha.'</span>
                                </div>';
                }else{
                    $output .= '<div class="chooseAddress">
                                    <input type="radio" name="address">
                                    <span class="labelAddress">'.$add->dc_sonha.'</span>
                                </div>';
                }
            }
            $fee = Address::find($data)->ward->province->city->phivanchuyen;
            $total = $subtotal - $discount + $fee;
            return response()->json([
                'code' => 200,
                'message' => 'success',
                'output' => $output,
                'fee' => number_format($fee),
                'total' => number_format($total),
                'total1' => $total,
            ],200);
        }
    }

    public function addShip(Request $request) {
        if($request) {
            $subtotal = 0;
            $discount = 0;
            $total = 0;
            $fee = 0;

            $add = Address::findOrFail($request->id);
            $id_ward = Ward::find($add->xp_id);
            $id_province = $id_ward->province->qh_id;
            $province = Province::find($id_province);
            $fee = $province->city->phivanchuyen;
            $carts = Session::get('cart');
            foreach ($carts as $key => $cart) {
                foreach ($cart as $key => $product) {
                    if($key != 0) {
                        $subtotal += $product['total'];
                    }else
                        if(count($product) > 0){
                            $discount += $product['voucherPrice'];
                        }
                }
            }
            $total = $subtotal - $discount + $fee;
            return response()->json([
                'code' => 200,
                'fee' => number_format($fee),
                'total' => number_format($total),
                'total1' => $total,
            ],200);
        }
    }

    public function payment(Request $request) {
        $dt = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        do {
            $number = random_int(0, 999);
            $code = 'MDH'.$number;
        } while (Order::where("dh_madonhang", "=", $code)->first());
        if($request) {
            $carts = Session::get('cart');
            $kh_id = Session::get('customer_id');
            $dataCreateOrder = Order::insertGetId([
                'dh_madonhang' => $code,
                'dh_tongtien' => $request->total,
                'dh_trangthai' => 0,
                'dh_ghichu' => $request->note,
                'dh_thoigiandathang' => $dt,
                'ht_id' => $request->ship,
                'dc_id' => $request->address,
                'created_at' => $dt,
                'updated_at' => $dt,
            ]);

            //lay tong tien va id_mgg
            foreach ($carts as $key => $cart){
                $total_product_ncc[$key] = 0;
                $voucher_id[$key] = '';
                $voucher_price[$key] = 0;
                foreach ($cart as $key2 => $item) {
                    if($key2 != 0) {
                        $total_product_ncc[$key] += $item['total'];
                    }else if($key2 == 0 && count($item) > 0){
                        $voucher_id[$key] = (int)$item['id'];
                        $voucher_price[$key] = (int)$item['voucherPrice'];
                    }
                }
            }
            //insert vao csdl
            foreach ($carts as $key =>$cart) {
                if($voucher_id[$key] != ''){
                    $dataCreateOrderNCC = OrderNCC::insertGetId([
                    'dh_id' => $dataCreateOrder,
                    'ncc_id' => $key,
                    'mgg_id' => $voucher_id[$key],
                    'tongtien' => $total_product_ncc[$key] - $voucher_price[$key],
                    'created_at' => $dt,
                    'updated_at' => $dt,
                    'trangthai' => 0,
                ]);
                }else{
                    $dataCreateOrderNCC = OrderNCC::insertGetId([
                        'dh_id' => $dataCreateOrder,
                        'ncc_id' => $key,
                        'tongtien' => $total_product_ncc[$key],
                        'trangthai' => 0,
                        'created_at' => $dt,
                        'updated_at' => $dt,
                    ]);
                }
                foreach ($cart as $key2 => $item){
                    if($key2 != 0){
                        if($item['id_discount'] != 0){
                            $dataCreateOrderDetail = OrderDetail::create([
                                'dhncc_id' => $dataCreateOrderNCC,
                                'sp_id' => $key2,
                                'km_id' => $item['id_discount'],
                                'gia' => $item['price_discount'],
                                'soluong' => $item['qty'],
                            ]);
                        }else{
                            $dataCreateOrderDetail = OrderDetail::create([
                                'dhncc_id' => $dataCreateOrderNCC,
                                'sp_id' => $key2,
                                'gia' => $item['price_discount'],
                                'soluong' => $item['qty'],
                            ]);
                        }
                    }
                }
            }
            Session::forget('cart');
            return response()->json([
                'code' => 200,
                'url' => route('trangchu'),
            ],200);
        }
    }
}
