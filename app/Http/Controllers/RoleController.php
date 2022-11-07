<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Models\Role;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();

        return view('roles.index', compact('roles'));
    }

    public function create(Role $role)
    {
        return view ('roles.create', ['role'=>$role]);
    }

    public function store(Request $request)
    {
        $role = new Role();

        $role->name = $request->get('name');
        $role->guard_name = $request->get('guard_name');

        $role->save();

        return redirect('roles');
    }

    public function show(Request $request, Role $role)
    {   
        if($request->get('role_id')){

            $permisos = $request->get('permisos');
            $role_id = $request->get('role_id');
            //$role = Role::find($request->get('role_id'));

            $borrar = DB::table('role_has_permissions')->where('role_id',$role_id)->delete();

            foreach ($permisos as $data){
                
               $permission = Permission::find($data);
               $role = Role::find($role_id);
               $permission->assignRole($role);               
            }
            return redirect('roles');
        }
        else{
            $roles = Role::find($role);
            $role_id = $roles[0]->id;
            $permissions = Permission::all();
            //dd($role_id);
            $permisos = DB::table('role_has_permissions')->Where('role_id',$role_id)->get();
            //dd($permisos);
        
            return view('roles.permisos', ['roles'=>$roles, 'permisos'=>$permisos])->with('permissions',$permissions);
        }
    }

    public function edit($id)
    {
        $role = Role::find($id);
        return view('roles.edit')->with('role',$role);
    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);

        $role->name = $request->get('name');
        $role->guard_name = $request->get('guard_name');

        $role->save();

        return redirect('roles');
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();

        return redirect('roles');
    }
}
