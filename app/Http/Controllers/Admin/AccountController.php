<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\AccountShipperAdd;
use Session;

session_start();
class AccountController extends Controller
{
    private $user;
    public function __construct(User $user) {
        $this->user = $user;
    }
    public function index() {
        $users= $this->user->latest()->paginate(10);
        return view('admin.manager.account.index', compact('users',));
    }

    public function changeStatus(Request $request) {
        $dt = Carbon::now('Asia/Ho_Chi_Minh');
        $data = $request->id;
        $user = $this->user->find($data)->update([
            'trangthai' => 1,
            'email_verified_at' => $dt,
        ]);
        
        return response()->json([
            'code' => 200,
        ]);
    }

    public function create_shipper() {
        return view('admin.manager.account.create_shipper');
    }

    public function store_shipper(AccountShipperAdd $request) {
        $account = User::create([
            'name' => $request->name,
            'email' => $request->gh_email,
            'password' => bcrypt($request->password),
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'trangthai' => 1,
            'loaitaikhoan' => 2,
        ]);
        Toastr::success('Thêm tài khoản mới thành công!', 'Thành công');
        return back();
    }
}
