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

    public function edit($id)
    {
        $permission = Permission::find($id);
        return view('admin.nhacungcap.permission.edit',compact('permission'));
    }

    public function update(Request $request,$id)
    {
        $permission = Permission::findOrFail($id)->update([
            'name' => $request->name,
        ]);
        Return redirect()->route('sup.permission.list');
    }

    public function delete(Request $request)
    {
        $permission = Permission::findOrFail($request->id)->delete();

        return response()->json([
            'code' => 200,
        ]);
    }
}
