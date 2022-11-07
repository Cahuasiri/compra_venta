<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo_cliente;

class Grupo_clienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grupo_clientes = Grupo_cliente::all();

        return view('grupo_clientes.index', ['grupo_clientes'=>$grupo_clientes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Grupo_cliente $grupo_cliente)
    {
        return view('grupo_clientes.create',['grupo_cliente'=>$grupo_cliente]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $grupo_cliente = new Grupo_cliente();

       $request->validate([
            'nombre'     =>  'required',
            'porcentaje'   =>  'required'
       ]);

       $grupo_cliente->nombre = $request->get('nombre');
       $grupo_cliente->porcentaje = $request->get('porcentaje');

       $grupo_cliente->save();

       return redirect('grupo_clientes')->with('message','Creado correctamente');
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
        $grupo_cliente = Grupo_cliente::find($id);
        return view('grupo_clientes.edit')->with('grupo_cliente', $grupo_cliente);
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
        $grupo_cliente = Grupo_cliente::find($id);
        $request->validate([
            'nombre'     =>  'required',
            'porcentaje'   =>  'required'
       ]);

        $grupo_cliente->nombre = $request->get('nombre');
        $grupo_cliente->porcentaje = $request->get('porcentaje');

        $grupo_cliente->save();

        return redirect('grupo_clientes')->with('message','Modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
