<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;


class RoleController extends Controller
{
    //

    public function index(){

        // $roles = Role::all();

        $user = Auth::user();
        if (!$user->hasPermissionTo('voir roles')) {
            return redirect()->back();
        }

        $roles = Role::whereNotIn('name', ['Super Admin'])->get();
        return view("roles.index")->with("roles", $roles);
    }

    public function create(){
        $user = Auth::user();
        return view("roles.create")->with("user", $user);
    }

    public function store(){

        request()->validate([
            'name' => ['required', 'unique:roles'],
        ]);

        $role = new Role;
        
        $role->name = request("name");
        $role->guard_name = "web";

        $role->save();

        return redirect()->route("roles.index")->with("message", "role a été ajouté!");
    }


    public function edit($id){
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view("roles.edit")->with("role", $role)->with("permissions", $permissions);
    }

    public function update(Request $request, $id){

        $role = Role::findOrFail($id);
        $role->name = request("name");

        $role->update();
        return redirect()->route("roles.index")->with("message", "role modifié !");

    }

    public function destroy($id){
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->back()->with("message", "role a été supprimé !");
    }

    public function givePermission(Request $request, $id){

        $role = Role::findOrFail($id);

        if($role->hasPermissionTo($request->permission)){
            return redirect()->back()->with("message", "permission exists !"); 
        }

        $role->givePermissionTo($request->permission);
        return redirect()->back()->with("message", "permission ajoutée !"); 

    }

    public function revokePermission($role_id, $permission_id){
        $role = Role::findOrFail($role_id);
        $permission = Permission::findOrFail($permission_id);

        if($role->hasPermissionTo($permission)){
            $role->revokePermissionTo($permission);
            return redirect()->back()->with("message","permission dissocié à ce role");
        }
    }

}
