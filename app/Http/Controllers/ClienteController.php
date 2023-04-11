<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cliente;
use App\Models\Grupo_cliente;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::All();
        return view('clientes.index', ['clientes'=>$clientes]);
    }

    public function create(Cliente $cliente)
    {
        $grupo_clientes = Grupo_cliente::all();
        return view('clientes.create',['grupo_clientes'=>$grupo_clientes,'cliente'=>$cliente]);
    }

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

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $grupo_clientes = Grupo_cliente::all();
        $cliente = Cliente::find($id);
        return view('clientes.edit', ['grupo_clientes'=>$grupo_clientes, 'cliente'=>$cliente]);
    }

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

    public function destroy($id)
    {
        $cliente = Cliente::find($id);
        $ventas = DB::table('ventas')->where('cliente_id',$id)->get();        
        $registros= count($ventas);
        
        if($registros >= '1'){
            return redirect('clientes')->with('eliminar', 'no');
        }
        else{
            $cliente->delete();
            return redirect('clientes')->with('eliminar', 'ok');
        }
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
