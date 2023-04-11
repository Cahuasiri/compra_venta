<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Proveedore;
use App\Models\Detalle_ingreso_producto;
use App\Models\Compra_producto;

class ProveedoreController extends Controller
{

    public function index()
    {
       $proveedores = Proveedore::all();
        return view('proveedores.index', compact('proveedores'));
    }

    public function create(Proveedore $proveedore)
    {
        return view('proveedores.create',['proveedore'=>$proveedore]);
    }

    public function store(Request $request)
    {
        $proveedores = new Proveedore();

        $proveedores->nombre = $request->get('nombre');
        $proveedores->nit = $request->get('nit');
        $proveedores->email = $request->get('email');
        $proveedores->telefono = $request->get('telefono');
        $proveedores->direccion = $request->get('direccion');
        $proveedores->pais = $request->get('pais');
        $proveedores->ciudad = $request->get('ciudad');

        $proveedores->save();        
        return redirect('proveedores')->with('message','Creado correctamente');

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
       $proveedore = Proveedore::find($id);
       return view('proveedores.edit')->with('proveedore', $proveedore);
    }

    public function update(Request $request, $id)
    {
        $proveedores = Proveedore::find($id);

        $proveedores->nombre = $request->get('nombre');
        $proveedores->nit = $request->get('nit');
        $proveedores->email = $request->get('email');
        $proveedores->telefono = $request->get('telefono');
        $proveedores->direccion = $request->get('direccion');
        $proveedores->pais = $request->get('pais');
        $proveedores->ciudad = $request->get('ciudad');
        
        $proveedores->save();
        return redirect('proveedores')->with('message','Modificado correctamente');

    }

    public function destroy($id)
    {   
        $proveedore = Proveedore::find($id);
        $compra_producto = DB::table('compra_productos')->where('proveedor_id',$id)->get();
        $registros= count($compra_producto);
        if($registros >= '1'){
            return redirect('proveedores')->with('eliminar', 'no');
        }
        else{
            $proveedore->delete();
            return redirect('proveedores')->with('eliminar', 'ok');
        }
    }
}
