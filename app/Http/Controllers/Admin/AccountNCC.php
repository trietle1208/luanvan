<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterManufacture;
use Illuminate\Http\Request;
use App\Models\Manufacture;
use App\Models\User;
class AccountNCC extends Controller
{
    private $ncc;
    private $user;
    public function __construct(Manufacture $ncc, User $user) {
        $this->ncc = $ncc;
        $this->user = $user;
    }
    public function store(RegisterManufacture $request){
        $thongtin = $this->ncc->create([
            'ncc_ten' => $request->name,
            'ncc_diachi'=> $request->address,
            'ncc_sdt' => $request->phone,
            'ncc_mota' => $request->desc,
        ]);
        
        $this->user->find(auth()->id())->update([
            'ncc_id' => $thongtin->ncc_id,
        ]);
        $user = User::find(auth()->id());
        $user->assignRole('Admin nhà cung cấp');
        return redirect()->route('home');
    }
}
