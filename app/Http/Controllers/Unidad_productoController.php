<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unidad_producto;
use App\Models\Producto;

class Unidad_productoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unidades = Unidad_producto::all();

        return view('unidades.index', ['unidades'=>$unidades]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Unidad_producto $unidad)
    {
        return view('unidades.create',['unidad'=>$unidad]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $unidades = new Unidad_Producto();

       $request->validate([
            'codigo'     =>  'required',
            'nombre'   =>  'required'
       ]);

       $unidades->codigo = $request->get('codigo');
       $unidades->nombre = $request->get('nombre');

       $unidades->save();

       return redirect('unidades')->with('message','Creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unidad = Unidad_producto::find($id);
        return view('unidades.edit')->with('unidad', $unidad);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $unidad = Unidad_producto::find($id);
        $request->validate([
            'codigo'     =>  'required',
            'nombre'   =>  'required'
       ]);

        $unidad->codigo = $request->get('codigo');
        $unidad->nombre = $request->get('nombre');

        $unidad->save();

        return redirect('unidades')->with('message','Modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         //Controlando si tiene dependencias
         $producto = Producto::where('unidad_producto_id',$id)->first();
         if($producto === null){
             $unidad = Unidad_producto::find($id);  
             $unidad->delete();
             return redirect('unidades')->with('message','Eliminado Correctamente');
         }
         else{
             return redirect('unidades')->with('message','La Unidad tiene dependencias no se puede borrar');    
         }
    }
}
