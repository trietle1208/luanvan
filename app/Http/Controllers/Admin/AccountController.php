<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
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
        $data = $request->id;
        $user = $this->user->find($data);
        if($user->trangthai == 0){
            $this->user->find($data)->update([
                'trangthai' => 1,
            ]);
            $output = 'Đã duyêt';
            return response()->json($output);
        } else {
            $this->user->find($data)->update([
                'trangthai' => 0,
            ]);
            $output = 'Duyêt';
            return response()->json($output);
            'commit';
        }
    }
}
