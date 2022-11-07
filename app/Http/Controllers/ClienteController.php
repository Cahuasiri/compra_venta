<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Grupo_cliente;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::All();

        return view('clientes.index', ['clientes'=>$clientes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Cliente $cliente)
    {
        $grupo_clientes = Grupo_cliente::all();

        return view('clientes.create',['grupo_clientes'=>$grupo_clientes,'cliente'=>$cliente]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cliente = new Cliente();
        $cliente->grupo_cliente_id = $request->get('grupo_cliente_id');
        $cliente->nombre_empresa = $request->get('nombre_empresa');
        $cliente->nombre_cliente = $request->get('nombre_cliente');
        $cliente->email = $request->get('email');
        $cliente->nit_ci = $request->get('nit_ci');
        $cliente->telefono = $request->get('telefono');
        $cliente->direccion = $request->get('direccion');

        $cliente->save();

        return redirect('clientes')->with('message','Guardado correctamente');
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
        $grupo_clientes = Grupo_cliente::all();

        $cliente = Cliente::find($id);

        return view('clientes.edit', ['grupo_clientes'=>$grupo_clientes, 'cliente'=>$cliente]);
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
        $cliente = Cliente::find($id);
        $cliente->grupo_cliente_id = $request->get('grupo_cliente_id');
        $cliente->nombre_empresa = $request->get('nombre_empresa');
        $cliente->nombre_cliente = $request->get('nombre_cliente');
        $cliente->email = $request->get('email');
        $cliente->nit_ci = $request->get('nit_ci');
        $cliente->telefono = $request->get('telefono');
        $cliente->direccion = $request->get('direccion');

        $cliente->save();

        return redirect('clientes')->with('message','Modificado correctamente');
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

    public function registrar_cliente(Request $request){

        $cliente = new Cliente();
        $cliente->grupo_cliente_id = $request->get('grupo_cliente_id');
        $cliente->nombre_empresa = $request->get('nombre_empresa');
        $cliente->nombre_cliente = $request->get('nombre_cliente');
        $cliente->email = $request->get('email');
        $cliente->nit_ci = $request->get('nit_ci');
        $cliente->telefono = $request->get('telefono');
        $cliente->direccion = $request->get('direccion');

        $cliente->save();
        //$producto->save();
        
        //$ultimo_producto = Producto::latest()->first();

        $clientes = Cliente::all();

        return response()->json(['clientes'=>$clientes]);
    }
}
