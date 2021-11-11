<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Notifications\ShipperNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::orderBy('dh_thoigiandathang','DESC')->get();
        return view('admin.manager.order.index', compact('orders'));
    }

    public function orderDetail(Request $request){
        $order = Order::find($request->id);
        $subtotal = 0;
        $subtotal_ncc = 0;
        $voucher = 0;
        $fee = $order->address->ward->province->city->phivanchuyen;
        foreach ($order->orderNCC as $orderNCC) {
            foreach ($orderNCC->orderDetail as $detail){
                $subtotal += $detail->gia*$detail->soluong;
            }
        }

        foreach ($order->orderNCC as $orderNCC) {
            $subtotal_ncc = 0;
            foreach ($orderNCC->orderDetail as $detail){
                $subtotal_ncc += $detail->gia*$detail->soluong;
            }

            if($orderNCC->mgg_id != null){
                if($orderNCC->voucher->mgg_hinhthuc == 0)
                {
                    $voucher += $orderNCC->voucher->mgg_sotiengiam;
                }
                else
                {
                    $voucher += ($subtotal_ncc*$orderNCC->voucher->mgg_sotiengiam)/100;
                }
            }
        }
        
        return response()->json([
            'code' => 200,
            'output' => view('admin.manager.order.order-detail',compact('order','subtotal','voucher','fee'))->render(),
        ]);
    }

    public function listShipper(Request $request){
        $shippers = User::where('loaitaikhoan',2)->orderBy('created_at','DESC')->get();
        $order = Order::find($request->id);
        return response()->json([
            'code' => 200,
            'output' => view('admin.manager.order.list-shipper',compact('shippers','order'))->render(),
        ]);
    }

    public function chooseShipper(Request $request){
        Order::find($request->id_order)->update([
            'gh_id' => $request->id_shipper,
        ]);
        $user = User::find($request->id_shipper);
        $order = Order::find($request->id_order)->load('address.customer');
        Notification::send($user, new ShipperNotification($order));
        return response()->json([
            'code' => 200,
            'message' => 'Chọn shipper thành công!',
            'title' => 'Thành công',
        ]);
    }

    public function listOrderShipper(Request $request){
        $orders = Order::where('gh_id',Auth::id())->orderBy('dh_thoigiandathang','DESC')->get();
        return view('admin.manager.order.list-order-shipper', compact('orders'));
    }

    public function selectShipOrder(Request $request){
        $order_update = Order::find($request->id_order)->update([
            'dh_trangthai' => 2,
            'dh_thoigiangiaohang' => Carbon::now()->format('Y-m-d'),
        ]);

        $order = Order::find($request->id_order);
        foreach ($order->orderNCC as $orderNCC) {
            $orderNCC->update([
                'trangthai' => 3,
                'thoigiangiaohang' => Carbon::now()->format('Y-m-d'),
                'gh_id' => $request->id_shipper,
            ]);
        }

        return response()->json([
            'code' => 200,
            'message' => 'Đã nhận đơn hàng thành công!',
            'title' => 'Thành công',
        ]);
    }

    public function finishShipOrder(Request $request){
        $order_update = Order::find($request->id_order)->update([
            'dh_trangthai' => 3,
            'dh_thoigiannhanhang' => Carbon::now()->format('Y-m-d'),
        ]);

        $order = Order::find($request->id_order);
        foreach ($order->orderNCC as $orderNCC) {
            $orderNCC->update([
                'trangthai' => 4,
                'thoigiannhanhang' => Carbon::now()->format('Y-m-d'),
            ]);
        }

        $address = Order::find($request->id_order)->address()->first();
        $customer = $address->customer()->first();
        
        $to_email = $customer->kh_email;
        $to_name = $customer->kh_hovaten;
        Mail::send('admin.nhacungcap.order.send_mail', array('order' => $order, 'address' => $address, 'customer' => $customer), function($message) use ($to_email,$to_name){
            $message->to($to_email,$to_name)->subject('Xác nhận nhận hàng!');
            $message->from('lmtriet1208@gmail.com','THẾ GIỚI LINH KIỆN')->subject('Xác nhận nhận hàng!');
        });

        return response()->json([
            'code' => 200,
            'message' => 'Xác nhận giao hàng thành công!',
            'title' => 'Thành công',
        ]);
    }
}
