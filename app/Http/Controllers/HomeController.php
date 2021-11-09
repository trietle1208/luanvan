<?php

namespace App\Http\Controllers;

use App\Models\OrderNCC;
use App\Models\Product;
use App\Models\Receipt;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Brian2694\Toastr\Toastr;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(isset(Auth::user()->ncc_id)){
            $count_favorites = 0;
            $favorites = Wishlist::with(['product' => function($query){
                $query->where('ncc_id',Auth::user()->ncc_id);
            }])->get();
            foreach ($favorites as $item){
                if($item['product'] != null) {
                    $count_favorites++;
                }
            }
            $count_order = OrderNCC::where('ncc_id',Auth::user()->ncc_id)->count();
            $total_order = OrderNCC::where('ncc_id',Auth::user()->ncc_id)->sum('tongtien');
            $count_product = Product::where('ncc_id',Auth::user()->ncc_id)->count();
            $count_receipt = Receipt::where('ncc_id',Auth::user()->ncc_id)->count();
            $count_voucher = Voucher::where('ncc_id',Auth::user()->ncc_id)->count();
            $count_account = User::where('ncc_id',Auth::user()->ncc->ncc_id)->count();
            return view('admin.manager.admin-dashbroad',
            compact('count_favorites','count_order','total_order','count_product','count_receipt','count_voucher','count_account'));
        }else{
            $count_order = 0;
            $total_order = 0;
            $count_favorites = 0;
            $count_product = 0;
            $count_receipt = 0;
            $count_voucher = 0;
            $count_account = 0;
            return view('admin.manager.admin-dashbroad',compact('count_favorites','count_order','total_order','count_product','count_receipt','count_voucher','count_account'));
        }
        
    }

    public function notitication(){
        $user = User::find(Auth::id());
        $notifications = $user->unreadnotifications;
        return view('admin.component.top-bar-notification',compact('notifications'))->render();
    }

    public function seen($id){
        $user = User::find(Auth::id());
        $notification = $user->notifications->where('id',$id)->first();
        $notification->markAsRead();
        
        return redirect()->route($notification['data']['name_route']);
    }
}
