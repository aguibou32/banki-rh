<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class PermissionController extends Controller
{
    public function index(){
        $permissions = Permission::all();
        return view("permissions.index")->with("permissions", $permissions);
    }

    public function create(){
        return redirect()->back();
        return view("permissions.create");
    }

    public function store(){
        
        return redirect()->back();
        request()->validate([
            'name' => ['required', 'unique:permissions'],
        ]);

        $role = new Permission;
        $role->name = request("name");
        $role->save();

        return redirect()->route("permissions.index")->with("message", "permission a été ajouté!");
    }

    public function edit($id){
        $permission = Permission::findOrFail($id);
        $roles = Role::all();

        return view("permissions.edit")->with("permission", $permission)->with("roles", $roles);
    }

    public function update(Request $request, $id){

        $permission = Permission::findOrFail($id);
        $permission->name = request("name");

        $permission->save();
        return redirect()->route("permissions.index")->with("message", "permission modifié !");

    }


    public function destroy($id){
        return redirect()->back();

        // $permission = Permission::findOrFail($id);
        // $permission->delete();

        // return redirect()->back()->with("message", "permission a été supprimé !");
    }


    public function assignRole(Request $request, $id){

        $permission = Permission::findOrFail($id);

        if($permission->hasRole($request->role)){
            return redirect()->back()->with("message", " exists !"); 
        }

        $permission->assignRole($request->role);
        return redirect()->back()->with("message", "role ajoutée !"); 

    }

    public function removeRole($permission_id, $role_id){
        $permission = Permission::findOrFail($permission_id);
        $role = Role::findOrFail($role_id);

        if($permission->hasRole($role)){
            $permission->removeRole($role);
            return redirect()->back()->with("message","role suprimé");
        }
        else{
            return redirect()->back()->with("message","role n'existe pas");
        }
    }
}
