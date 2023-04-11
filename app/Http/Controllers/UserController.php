<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Models\Model_has_role;


use App\Models\Persona;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
       // $personas = Persona::all();
       $user = new User();
        return view('users.create', ['user'=>$user]);
    }

    public function store(Request $request)
    {   
        $user = new User();
       // $persona = Persona::find($request->get('persona_id'));
       $request->validate([
        'name'     =>   'required',
        'email'     =>  'required|unique:users|email:rfc,dns',
        'password'   =>  'required'
        ],
        [
            'name.required'       => 'El nombre es Requerido',
            'email.required'  =>  'El campo es obligatorio',
            'email.unique'    => 'El Correo ya Existe',
            'email.email'     => 'Debe ser un correo Valido',
            'password.required' => 'Campo Requerido'
        ]);       

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));

        $user->save();
        return redirect('users');

    }

    public function show($id)
    {
        $user = User::find($id);

        $roles = Role::all();
        $users_rol= Model_has_role::all();
        return view('users.asignar_roles',['user'=>$user, 'roles'=>$roles, 'users_rol'=>$users_rol]);
    }

    public function edit($id)
    {   
        //$roles = Role::all();
        //return view('users.edit',compact('user','roles'));
        $user = User::find($id);        
        return view('users.edit')->with('user',$user);

    }

    public function update(Request $request, $id)
    {   
        //$user = new User();
        $users = User::find($id);
        $request->validate([
            'name'     =>   'required',
            'email'     =>  'required|email:rfc,dns',
            'password'   =>  'required'
            ],
            [
                'name.required'       => 'El nombre es Requerido',
                'email.required'  =>  'El campo es obligatorio',
                'email.unique'    => 'El Correo ya Existe',
                'email.email'     => 'Debe ser un correo Valido',
                'password.required' => 'Campo Requerido'
            ]);

        $users->name = $request->get('name');
        $users->email = $request->get('email');
        $users->password = bcrypt($request->get('password'));
        $users->save();

        return redirect('users');
        //$user->roles()->sync($request->roles);
        //return redirect()->route('users.edit',$user)->with('info', 'Se asigno los roles correctamente');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user_rol = DB::table('model_has_roles')->where('model_id',$id)->get();
        $registros= count($user_rol);
        if($registros >= '1'){
            return redirect('users')->with('eliminar', 'no');
        }
        else{
            $user->delete();
            return redirect('users')->with('eliminar', 'ok');
        }
    }

    public function asignar_roles(Request $request, User $user){
        
        $user->roles()->sync($request->roles);

        return redirect('users');
    }
}
