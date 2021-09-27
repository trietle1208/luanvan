<?php

namespace App\Http\Controllers\NCC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function create() {
        return view('admin.nhacungcap.role.create');
    }

    public function index() {
        $roles = Role::all();
        return view('admin.nhacungcap.role.index',compact('roles'));
    }

    public function store(Request $request) {
        $role = Role::create([
           'name' => $request->name,
        ]);

        Return redirect()->route('sup.role.create');
    }

    public function addPermission($id) {
        $permissions = Permission::all();
        $role = Role::find($id);
        return view('admin.nhacungcap.role.add-permission',compact('permissions', 'role'))->render();
    }

    public function storePermission(Request $request,$id){
        $role = Role::findOrFail($id);
        $role->syncPermissions($request->permission);

        return back();
    }

    public function edit($id) {
        $role = Role::findOrFail($id);
        return view('admin.nhacungcap.role.edit',compact('role'));
    }

    public function update($id, Request $request) {
        $role = Role::findOrFail($id)->update([
            'name' => $request->name,
        ]);
        Return redirect()->route('sup.role.list');
    }
}
