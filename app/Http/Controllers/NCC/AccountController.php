<?php

namespace App\Http\Controllers\NCC;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountAdd;
use App\Models\Info;
use App\Models\Manufacture;
use App\Models\User;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;

class AccountController extends Controller
{
    use StorageImageTrait;
    private $info;
    private $ncc;
    public function __construct(Info $info, Manufacture $ncc) {
        $this->info = $info;
        $this->ncc = $ncc;
    }
    public function index() {
        $name = User::where('id',Auth::id())->first();
        $ncc = Manufacture::find(Auth::user()->ncc_id);
        $info = Manufacture::where('ncc_id',Auth::user()->ncc_id)->first();
        $roles = $name->getRoleNames();
        return view('admin.nhacungcap.account.index',compact('info','name','ncc','roles'));
    }

    public function store(Request $request) {
        $info = Info::updateOrCreate(
            [
                'us_id' => Auth::user()->id,
            ],
            [
                'tt_diachi' => $request->address,
                'tt_sdt' => $request->phone,
                'tt_gioitinh' => $request->sex,
                'tt_ngaysinh' => $request->age,
            ]);

        return redirect()->route('sup.account.index');
    }

    public function store_ncc(Request $request) {
        $dataUpload = $this->storageTraitUpload($request, 'image', 'ncc');
        $ncc = Manufacture::updateOrCreate(
            [
                'ncc_id' => Auth::user()->ncc_id,
            ],
            [
                'ncc_ten' => $request->name,
                'ncc_diachi' => $request->address,
                'ncc_sdt' => $request->phone,
                'ncc_mota' => $request->desc,
                'ncc_hinhanh' => $dataUpload['file_path'],
            ]);


        return redirect()->route('sup.account.index');
    }

    public function index_account() {
        $accounts = User::where('ncc_id',Auth::user()->ncc_id)->get();

        return view('admin.nhacungcap.account.index-account',compact('accounts'));
    }

    public function create_account() {
        return view('admin.nhacungcap.account.create');
    }

    public function store_account(Request $request) {
        $account = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'ncc_id' => Auth::user()->ncc_id,
            'trangthai' => 1,
        ]);
        return back();
    }

    public function addRole($id){
        $user = User::find($id);
        $roles = Role::all();

        return view('admin.nhacungcap.account.add-role',compact('user','roles'))->render();
    }

    public function storeRole(Request $request,$id){
        $user = User::find($id);
        $user->syncRoles($request->role);
        return back();
    }

}
