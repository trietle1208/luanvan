<?php

namespace App\Http\Controllers\NCC;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderNCC;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class OrderController extends Controller
{
    public function index() {
        $orders = OrderNCC::where('ncc_id',Auth::user()->ncc->ncc_id)->orderBy('created_at','DESC')->paginate(10);

        return view('admin.nhacungcap.order.index',compact('orders'));
    }

    public function detail(Request $request){
        if($request->id){
            $details = OrderDetail::where('dhncc_id',$request->id)->get();
            $order = OrderNCC::findOrFail($request->id);
            return view('admin.nhacungcap.order.detail',compact('details','order'))->render();
        }
    }

    public function changeStatus(Request $request){
        if($request){
            $check = 0;
            $count = 0;
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

            return response()->json([
               'code' => 200,
               'message' => 'success',
            ]);
        }
    }
}
