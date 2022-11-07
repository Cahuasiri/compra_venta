<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;
use App\Models\Producto;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marcas = Marca::all();
        return view('marcas.index', ['marcas'=>$marcas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Marca $marca)
    {
        return view('marcas.create',['marca'=>$marca]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $marcas = new Marca();

       $request->validate([
            'nombre'     =>  'required',
            'descripcion'   =>  'required'
       ]);

       $marcas->nombre = $request->get('nombre');
       $marcas->descripcion = $request->get('descripcion');

       $marcas->save();

       return redirect('marcas')->with('message','Creado correctamente');
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
        $marca = Marca::find($id);
        return view('marcas.edit')->with('marca', $marca);
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
        $marca = Marca::find($id);
        $request->validate([
            'nombre'     =>  'required',
            'descripcion'   =>  'required'
       ]);

        $marca->nombre = $request->get('nombre');
        $marca->descripcion = $request->get('descripcion');

        $marca->save();

        return redirect('marcas')->with('message','Modificado correctamente');
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
         $producto = Producto::where('marca_id',$id)->first();
         if($producto === null){
             $marca = Marca::find($id);  
             $marca->delete();
             return redirect('marcas')->with('message','Eliminado Correctamente');
         }
         else{
             return redirect('marcas')->with('message','La Categoria tiene dependencias no se puede borrar');    
         }
    }
}
