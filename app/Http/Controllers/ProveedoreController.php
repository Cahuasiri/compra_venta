<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        //controlando si tiene dependencias
        $compra_producto = Compra_producto::where('proveedor_id',$id)->first();
        if($compra_producto === null){
            $proveedore = Proveedore::find($id);
            $proveedore->delete();
            return redirect('proveedores')->with('message','Eliminado Correctamente');
        }
        else{
            return redirect('proveedores')->with('message','Proveedor tiene dependencias No se puede borrar');
        }        
    }
}
