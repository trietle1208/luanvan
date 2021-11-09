<?php

namespace App\Http\Controllers\NCC;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderNCC;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;
class OrderController extends Controller
{
    public function __construct(){
        $this->middleware(['permission:Edit Order'])->only(['index']);
        $this->middleware(['permission:Edit Order'])->only(['edit']);
        $this->middleware(['permission:Edit Order'])->only(['delete']);
    }
    public function index() {
        $orders = OrderNCC::where('ncc_id',Auth::user()->ncc->ncc_id)->orderBy('created_at','DESC')->get();
        $orders_0 = OrderNCC::where('ncc_id',Auth::user()->ncc->ncc_id)->where('trangthai',0)->orderBy('created_at','DESC')->get();
        $shipper = User::where('ncc_id',Auth::user()->ncc_id)->get();
        if($orders_0){
            $count = 0;
            foreach ($orders_0 as $item){
                $count++;
            }
            return view('admin.nhacungcap.order.index',compact('orders','orders_0','count','shipper'));
        }
        else{
            return view('admin.nhacungcap.order.index',compact('orders','shipper'));
        }

    }

    public function detail(Request $request){
        if($request->id){
            $subtotal = 0;
            $fee_ship = 0;
            $voucher_price = 0;
            $details = OrderDetail::where('dhncc_id',$request->id)->get();
            $order = OrderNCC::findOrFail($request->id);
            foreach ($details as $detail){
                $subtotal += ($detail->gia * $detail->soluong);
            }
            if($order->mgg_id != null){
                if($order->voucher->mgg_hinhthuc == 0)
                {
                    $voucher_price = $order->voucher->mgg_sotiengiam;
                }
                else
                {
                    $voucher_price = ($subtotal*$order->voucher->mgg_sotiengiam)/100;
                }
            }

            $total = $order->tongtien;
            return view('admin.nhacungcap.order.detail_order',compact('details','order','total','subtotal','voucher_price','fee_ship'))->render();
        }
    }

    public function changeStatus(Request $request){
        if($request){
            $check = 0;
            $count = 0;
            $count_order = 0;
            $orderNCC = OrderNCC::findOrFail($request->id)->update([
                'trangthai' => 1,
            ]);
            $order = Order::findOrFail($request->key);
            foreach($order->orderNCC as $item){
                $count++;
                if($item->trangthai == 1){
                    $check++;
                }
            }
            if($count == $check){
                Order::findOrFail($request->key)->update([
                   'dh_trangthai' => 1,
                ]);
            }
            $order_0 = OrderNCC::where('ncc_id',$request->idNCC)->where('trangthai',0)->get();
            foreach ($order_0 as $item){
                $count_order++;
            }
            return response()->json([
               'code' => 200,
               'message' => 'success',
                'count' => $count_order,
            ]);
        }
    }
    public function listShipper(Request $request){
        
    }
    public function chooseShipper(Request $request) {
        OrderNCC::find($request->key)->update([
           'gh_id' => $request->id,
        ]);
        return response()->json([
            'code' => 200,
            'message' => ('Chọn nhân viên giao hàng thành công!'),
            'title' => ('Thành công!'),
        ]);
    }

    public function listOrderShipper() {

        $orders_0 = OrderNCC::where('ncc_id',Auth::user()->ncc->ncc_id)->where('gh_id',Auth::id())->where('trangthai',1)->orderBy('created_at','DESC')->get();
        $orders = OrderNCC::where('gh_id',Auth::id())->orderBy('created_at','DESC')->get();
        if($orders_0){
            $count = 0;
            foreach ($orders_0 as $item){
                $count++;
            }
            return view('admin.nhacungcap.order.list_order_shipper',compact('orders','count','orders_0'));
        }else{
            return view('admin.nhacungcap.order.list_order_shipper',compact('orders'));
        }
    }

    public function selectShipOrder(Request $request) {
        $count = 0;
        $count_order = 0;
        $check = 0;
        $order_ncc = OrderNCC::find($request->key);
        $order_ncc->update([
            'thoigiangiaohang' => Carbon::now()->format('Y-m-d H:i:s'),
            'trangthai' => 3,
        ]);
        $order = Order::find($order_ncc->dh_id)->update([
            'dh_trangthai' => 2,
            'dh_thoigiangiaohang' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $orders_0 = OrderNCC::where('ncc_id',Auth::user()->ncc->ncc_id)->where('gh_id',Auth::id())->where('trangthai',1)->orderBy('created_at','DESC')->get();
        foreach ($orders_0 as $item) {
            $count++;
        }

        return response()->json([
           'code' => 200,
           'count' => $count,
           'message' => 'Nhận đơn hàng thành công!',
           'title' => 'Thành công!',
        ]);
    }

    public function finishShipOrder(Request $request) {
        $order = OrderNCC::find($request->key);
        $order_up = $order->update([
            'trangthai' => 4,
        ]);
        $address = Order::find($order->dh_id)->address()->first();
        $customer = $address->customer()->first();
        $ncc_name = $order->ncc()->first();
        $to_email = $customer->kh_email;
        $to_name = $customer->kh_hovaten;
        Mail::send('admin.nhacungcap.order.send_mail', array('order' => $order, 'address' => $address, 'customer' => $customer), function($message) use ($to_email,$to_name,$ncc_name){
            $message->to($to_email,$to_name)->subject('Xác nhận nhận hàng!');
            $message->from('lmtriet1208@gmail.com',$ncc_name['ncc_ten'])->subject('Xác nhận nhận hàng!');
        });
        return response()->json([
           'code' => 200,
           'message' => 'Xác nhận hoàn thành đơn hàng',
           'title' => 'Thành công'
        ]);
    }
}
