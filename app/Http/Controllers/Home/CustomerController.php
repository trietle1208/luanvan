<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Brand;
use App\Models\CatePosts;
use App\Models\Comment;
use App\Models\Customer;
use App\Models\DanhMuc;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderNCC;
use App\Models\Product;
use App\Models\Province;
use App\Models\ReceiptDetail;
use App\Models\Slide;
use App\Models\Social;
use App\Models\User;
use App\Models\Ward;
use App\Models\Wishlist;
use App\Notifications\CommentNotification;
use App\Traits\StorageImageTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class CustomerController extends Controller
{
    use StorageImageTrait;
    public function index() {
        
        return redirect()->route('trangchu');
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'kh_email' => 'required|unique:khachhang',
            'pass' => 'required',
            'phone' => 'required|numeric',
            'sex' => 'required',
            'date' => 'required|before: 18 years ago',
        ], [
            'name.required' => 'Vui lòng không để trống mục họ và tên.',
            'kh_email.required' => 'Vui lòng không để trống mục tài khoản Email.',
            'kh_email.unique' => 'Tên tài khoản Email đã được sử dụng.',
            'pass.required' => 'Vui lòng không để trống mục mật khẩu.',
            'phone.required' => 'Vui lòng không để trống mục số điện thoại.',
            'phone.numeric' => 'Mục số điện thoại phải là kiểu số.',
            'sex.required' => 'Mục giới tính không được để trống.',
            'date.required' => 'Vui lòng không để trống mục ngày sinh.',
            'date.before' => 'Bạn chưa đủ 18 tuổi để đăng kí tài khoản.',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'code' => 400,
                'errors' => $validator->errors()
            ]);
        }
        $data = [
            'kh_hovaten' => $request->name,
            'kh_email' => $request->kh_email,
            'kh_matkhau' => md5($request->pass),
            'kh_sdt' => $request->phone,
            'kh_ngaysinh' => $request->date,
            'kh_gioitinh' => $request->sex,
        ];

        $customer = DB::table('khachhang')->insertGetId($data);

        Session::put('customer_id',$customer);
        Session::put('customer_name',$request->name);

        // return redirect()->route('customer.index');
        return response()->json([
            'code' => 200,
        ]);
    }

    public function login(Request $request) {
        $customer = Customer::where('kh_email',$request->name)->where('kh_matkhau',md5($request->password))->first();
        $admin = User::where('email',$request->name)->first();
        if($customer) {
            Session::put('customer_id',$customer->kh_id);
            Session::put('customer_name',$customer->kh_hovaten);
            // return redirect()->route('checkout.index');
            return response()->json([
                'code' => 200,
            ],200);
        }
        else if($admin) {
            Session::put('admin_id',$admin->id);
            Session::put('admin_name',$admin->name);
            // return redirect()->route('trangchu');
            return response()->json([
                'code' => 200,
            ],200);
        }
        else{
            Session::put('message','Sai tên tài khoản hoặc mật khẩu');
            // return redirect()->route('customer.index');
            return response()->json([
                'code' => 400,
            ]);
        }
    }

    public function loginGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function loginFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function callback_google(){
        $kh = Socialite::driver('google')->stateless()->user();
        $authKH = $this->findOrCreateKH($kh,'google');
        return redirect()->route('checkout.index');
    }

    public function callback_facebook(){
        $kh = Socialite::driver('facebook')->stateless()->user();
        $this->findOrCreateKH($kh,'facebook');

        return redirect()->route('checkout.index');
    }

    public function findOrCreateKH($kh,$provider){
        $authKH = Social::where('provider_kh_id',$kh->id)->first();
        if($authKH) {
            $account = Customer::where('kh_id',$authKH->kh_id)->first();
            Session::put('customer_id',$account->kh_id);
            Session::put('customer_name',$account->kh_hovaten);
        }

        $login = new Social([
            'provider_kh_id' => $kh->id,
            'provider' => $provider,
        ]);

        $orang = Customer::where('kh_email',$kh->email)->first();
        $dt = date('Y-m-d H:i:s');
        if(!$orang){
            $orang = Customer::create([
                'kh_hovaten' => $kh->name,
                'kh_email' => $kh->email,
                'kh_matkhau' => null,
                'kh_sdt' => null,
                'kh_ngaysinh' => null,
                'kh_gioitinh' => 0,
                'kh_hinhanh' => $kh->avatar_original,
                'created_at' => $dt,
                'updated_at' => $dt,
            ]);
        }

        $login->login_gg()->associate($orang);
        $login->save();
        $account = Customer::where('kh_id',$login->kh_id)->first();
        Session::put('customer_id',$account->kh_id);
        Session::put('customer_name',$account->kh_hovaten);
        return redirect()->route('checkout.index');
    }
    public function logout() {
        Session::forget('customer_id');
        Session::forget('customer_name');
        Session::forget('admin_id');
        Session::forget('admin_name');
        return redirect()->route('trangchu');
    }

    public function profile() {
        $cateposts = CatePosts::all();
        $id = Session::get('customer_id');
        if($id) {
            $user = Customer::findOrFail($id);
            $address = $user->address->first();
            $add = Address::where('kh_id',$id)->get();
            return view('home.customer.profile',compact('user','address','add','cateposts'));
        }
    }

    public function detailOrder(Request $request){
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
        return view('home.customer.order-detail',compact('order','subtotal','fee','voucher'))->render();
    }

    public function updateOrder(Request $request){
        $qty_kho = ReceiptDetail::where('sp_id',$request->idsp)->orderBy('created_at','DESC')->first();
        if($request->qty > $qty_kho->soluong){
            return response()->json([
                'code' => 400,
                'message' => 'fail',
            ]);
        }else{
            $qty = Session::get('qty');
            if(!isset($qty)){
                $qty = OrderDetail::find($request->id_ctdh)->soluong;
            }
            Session::put('qty',$qty);
            OrderDetail::find($request->id_ctdh)->update([
                'soluong' => $request->qty,
            ]);
            $total_order_ncc = 0;
            $subtotal = 0;
            $total = 0;
            $voucher = 0;
            $fee = 0;
            $order_detail = OrderDetail::find($request->id_ctdh)->dhncc_id;
            $order_ncc = OrderNCC::find($order_detail);
            foreach ($order_ncc->orderDetail as $item){
                $total_order_ncc += $item->gia * $item->soluong;
            }
            $order_ncc->update([
                'tongtien' => $total_order_ncc,
            ]);
            $order_id = OrderNCC::find($order_detail)->dh_id;
            $order = Order::find($order_id);
            foreach ($order->orderNCC as $item){
                if(isset($item->mgg_id)){
                    $total += $item->tongtien;
                    if($item->tongtien >= $item->voucher->mgg_dieukien){
                        if($item->voucher->mgg_hinhthuc == 1){
                            $voucher += ($item->tongtien * $item->voucher->mgg_sotiengiam)/100;
                        }else{
                            $voucher += $item->voucher->mgg_sotiengiam;
                        }
                    }
                    else{
                        $order->update([
                            'mgg_id' => null,
                        ]);
                    }
                }else{
                    $total += $item->tongtien;
                }
            }
            $add = Address::findOrFail($order->dc_id);
            $id_ward = Ward::find($add->xp_id);
            $id_province = $id_ward->province->qh_id;
            $province = Province::find($id_province);
            $fee = $province->city->phivanchuyen;

            $total = $total - $voucher + $fee;
            $order->update([
                'dh_tongtien' => $total,
            ]);
            $subtotal = OrderDetail::find($request->id_ctdh)->gia * OrderDetail::find($request->id_ctdh)->soluong;

            return response()->json([
                'code' => 200,
                'total' => number_format($total),
                'subtotal' => number_format($subtotal),
            ]);
        }
    }

    public function addWishlist(Request $request){
       if($request->all()){
           $kh_id = Session::get('customer_id');
           $sp_id = (int)$request->id;
           Wishlist::updateOrCreate([
               'kh_id' => $kh_id,
               'sp_id' => $sp_id,
           ],[
               'kh_id' => $kh_id,
               'sp_id' => $sp_id,
           ]);

           $wishlist = Wishlist::where('kh_id',$kh_id)->get();
           return response()->json([
              'code' => 200,
              'wishlist' =>  view('home.components.wishlist',compact('wishlist'))->render(),
           ],200);
       }
    }

    public function deleteWishlist(Request $request){
        if($request->all()){
            $kh_id = Session::get('customer_id');
            $sp_id = (int)$request->id;
            $data = Wishlist::where('kh_id',$kh_id)->where('sp_id',$sp_id)->first();
            Wishlist::find($data->id_yt)->delete();
            $wishlist = Wishlist::where('kh_id',$kh_id)->get();
            return response()->json([
                'code' => 200,
                'wishlist' =>  view('home.components.wishlist',compact('wishlist'))->render(),
            ],200);
        }
    }

    public function showWishlist(Request $request){
        if($request->all()){
            $wishlist = Wishlist::where('kh_id',$request->id)->get();
            return response()->json([
                'code' => 200,
                'wishlist' =>  view('home.components.wishlist',compact('wishlist'))->render(),
            ],200);
        }
    }

    public function deleteOrder(Request $request){
        if($request){
            $orderUp = Order::find($request->id)->update([
                'dh_trangthai' => 4,
            ]);
            $order = Order::find($request->id);
            foreach ($order->orderNCC as $orderNCC){
                $orderNCC->update([
                   'trangthai' => 2,
                ]);
                foreach($orderNCC->orderDetail as $item){
                    OrderDetail::find($item->ctdh_id)->delete();
                }
            }
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ],200);
        }
    }

    public function updateInfo(Request $request){
        if($request){
            $user = Customer::find($request->id);
            return response()->json([
                'code' => 200,
                'user' =>  view('home.customer.update-info',compact('user'))->render(),
            ],200);
        }
    }

    public function saveUpdateInfo(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'phone' => 'required|numeric',
            'sex' => 'required',
            'date' => 'required',
        ],[
            'name.required' => 'Vui lòng không để trống mục họ và tên.',
            'phone.required' => 'Vui lòng không để trống mục số điện thoại.',
            'sex.required' => 'Vui lòng chọn giới tính.',
            'date.required' => 'Vui lòng không để trống mục ngày sinh.',
            'phone.numeric' => 'Số điện thoại nhập vào phải là kiểu số.',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'code' => 400,
                'errors' => $validator->errors(),
            ]);
        }
        $image = $this->storageTraitUploadCustomer($request,'image','customer');
        if($image){
            $output_image = '<img src="'.$image['file_path'].'" style="width: 200px; height: 200px" class="img-fluid">';
            if(Session::get('customer_id')){
                $id = Session::get('customer_id');
                Customer::find($id)->update([
                    'kh_hovaten' => $request->name,
                    'kh_sdt' => $request->phone,
                    'kh_ngaysinh' => $request->date,
                    'kh_gioitinh' => $request->sex,
                    'kh_hinhanh' => $image['file_path'],
                ]);
            }
        }else{
            $output_image = '';
            if(Session::get('customer_id')){
                $id = Session::get('customer_id');
                Customer::find($id)->update([
                    'kh_hovaten' => $request->name,
                    'kh_sdt' => $request->phone,
                    'kh_ngaysinh' => $request->date,
                    'kh_gioitinh' => $request->sex,
                ]);
            }
        }
        return response()->json([
            'code' => 200,
            'name' => $request->name,
            'phone' => $request->phone,
            'date' => $request->date,
            'sex' => $request->sex,
            'image' => $output_image,
        ]);
    }

    public function addComment(Request $request){
        try {
            Carbon::setLocale('vi');
            $now = Carbon::now('Asia/Ho_Chi_Minh');
            $dt = Carbon::now('Asia/Ho_Chi_Minh');
            DB::beginTransaction();
            $image = $this->storageTraitUploadCustomer($request,'image','comment');
            if($image){
                $comment = Comment::create([
                    'bl_noidung' => $request->text,
                    'bl_sosao' => $request->rating,
                    'bl_idcha' => null,
                    'bl_hinhanh' => $image['file_path'],
                    'sp_id' => $request->idsp,
                    'kh_id' => $request->id,
                    'us_id' => null,
                    'trangthai' => 0,
                ]);
            }else{
                $comment = Comment::create([
                    'bl_noidung' => $request->text,
                    'bl_sosao' => $request->rating,
                    'bl_idcha' => null,
                    'sp_id' => $request->idsp,
                    'kh_id' => $request->id,
                    'us_id' => null,
                    'trangthai' => 0,
                ]);
            }
            $comment = $comment->load('customer','product');
            $product = Product::find($request->idsp);
            $users = User::where('ncc_id',$product->ncc->ncc_id)->role(['Quản Lý Sản Phẩm','Admin nhà cung cấp'])->get();
            $notifi = Notification::send($users, new CommentNotification($comment));
            DB::commit();
            return response()->json([
            'code' => 200,
            ],200);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getLine() . '---' . $exception->getMessage());
        }
    }

    public function repComment(Request $request){
        if($request->id != null){
            Carbon::setLocale('vi');
            $now = Carbon::now('Asia/Ho_Chi_Minh');
            $dt = Carbon::now('Asia/Ho_Chi_Minh');
            $comment = Comment::create([
                'bl_noidung' => $request->text,
                'bl_sosao' => null,
                'bl_idcha' => $request->idbl,
                'sp_id' => $request->idsp,
                'kh_id' => null,
                'us_id' => $request->id,
                'trangthai' => 1,
            ]);           
            return response()->json([
                'code' => 200,
                'output' => view('home.customer.repcomment',compact('comment','dt','now'))->render(),
            ],200);
        }else{
            Carbon::setLocale('vi');
            $now = Carbon::now('Asia/Ho_Chi_Minh');
            $dt = Carbon::now('Asia/Ho_Chi_Minh');
            $comment = Comment::create([
                'bl_noidung' => $request->text,
                'bl_sosao' => null,
                'bl_idcha' => $request->idbl,
                'sp_id' => $request->idsp,
                'kh_id' => $request->kh,
                'us_id' => null,
                'trangthai' => 0,               
            ]);
            return response()->json([
                'code' => 200,
                // 'output' => view('home.customer.repcomment',compact('comment','dt','now'))->render(),
            ],200);
        }

    }

    public function quickView(Request $request){
        if($request){
            $count = 0;
            $star_1 = 0;
            $star_2 = 0;
            $star_3 = 0;
            $star_4 = 0;
            $star_5 = 0;
            $product = Product::find($request->id);
            $receiptdetail = ReceiptDetail::where('sp_id',$product->sp_id)->orderBy('created_at','DESC')->first();
            $quantityProduct = $receiptdetail->soluong;
            // $rating = $product->with('comment')->first();
            // dd($rating->toArray());
            foreach ($product->comment as $comment){
                if($comment['bl_sosao'] != null){
                    $count++;
                }
                if($comment['bl_sosao'] == 1){
                    $star_1++;
                }
                if($comment['bl_sosao'] == 2){
                    $star_2++;
                }
                if($comment['bl_sosao'] == 3){
                    $star_3++;
                }
                if($comment['bl_sosao'] == 4){
                    $star_4++;
                }
                if($comment['bl_sosao'] == 5){
                    $star_5++;
                }
            }
            return response()->json([
                'code' => 200,
                'product' => view('home.components.quickview',compact('product','quantityProduct','count','star_1','star_2','star_3','star_4','star_5'))->render(),
            ],200);
        }
    }

    public function followOrder(Request $request) {
        $order = Order::find($request->id);
        return response()->json([
            'code' => 200,
            'output' => view('home.customer.follow-order',compact('order'))->render(),
        ],200);
    }

    public function confirmFinishOrder(Request $request){
        $order_update = Order::find($request->id)->update([
            'dh_trangthai' => 5,
        ]);

        $order = Order::find($request->id);
        foreach ($order->orderNCC as $orderNCC) {
            $orderNCC->update([
                'trangthai' => 5,
            ]);
        }

        return response()->json([
            'code' => 200,
        ],200);
    }
}
