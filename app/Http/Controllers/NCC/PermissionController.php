<?php

namespace App\Http\Controllers\NCC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function create() {
        return view('admin.nhacungcap.permission.create');
    }

    public function index() {
        $permissions = Permission::all();
        return view('admin.nhacungcap.permission.index',compact('permissions'));
    }

    public function store(Request $request) {
        $permission = Permission::create([
            'name' => $request->name,
        ]);

        return redirect()->route('sup.permission.create');
    }


}
