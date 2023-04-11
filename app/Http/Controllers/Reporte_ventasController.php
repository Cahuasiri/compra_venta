<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Detalle_venta;
use App\Models\Cliente;
use DateTime;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;
use App\Models\User;

class Reporte_ventasController extends Controller
{
    public function index()
    {   
        $date = new DateTime(); 
        $dt= $date->format('Y-m-d');
        $fecha_inicio = "";
        $fecha_fin ="";
        $cliente_id = "";
        $user_id = "";

        $productos = Producto::Where('estado', 'A')->get();
        $clientes = Cliente::all();
        $users = User::all();

        //$ventas = Venta::with('cliente')->paginate();
        $ventas = DB::table('ventas')
                        ->join('clientes', 'ventas.cliente_id', '=','clientes.id')
                        ->join('users', 'ventas.usuario_id', '=', 'users.id')
                        ->orderBy('ventas.id', 'desc')
                        ->select('ventas.*','clientes.nombre_cliente as cliente','users.name as user_name')
                        ->get();
        return view('reportes.ventas_index', ['ventas'=>$ventas, 'fecha_inicio'=>$fecha_inicio, 
                    'fecha_fin'=>$fecha_fin,'productos'=>$productos,
                    'clientes'=>$clientes, 'users'=>$users, 'cliente_id'=>$cliente_id, 'user_id'=>$user_id]);
    }

    public function create(Request $request)
    {
        
    }

    public function store(Request $request)
    {
        $ventas = Venta::with('cliente')->paginate();
       
       return response()->json(['mensaje'=>'mensaje correcto', 'ventas'=>$ventas]); 
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $fecha_inicio = $request->get('fecha_inicio');
        $fecha_fin = $request->get('fecha_fin');
       // $producto_id = $request->get('producto_id');
        //dd($producto_id);
        $cliente_id = $request->get('cliente_id');
        $user_id    = $request->get('user_id');
        //dd($fecha_inicio);
        $date = new DateTime(); 
        $dt= $date->format('Y-m-d');

        $productos = Producto::Where('estado', 'A')->get();
        $clientes = Cliente::all();
        $users = User::all();
        
        // Cuando tiene solamente fechas
        if(($fecha_inicio != null)&&($cliente_id==null)&&($user_id==null)){
            $ventas = DB::table('ventas')
                        ->join('clientes', 'ventas.cliente_id', '=','clientes.id')
                        ->join('users', 'ventas.usuario_id', '=', 'users.id')
                        ->where('ventas.fecha_venta','>=',$fecha_inicio)
                        ->where('ventas.fecha_venta','<=',$fecha_fin)
                        ->orderBy('ventas.id', 'desc')
                        ->select('ventas.*','clientes.nombre_cliente as cliente', 'users.name as user_name')
                        ->get();
        }
        //cuando tiene fechas y cliente
        if(($fecha_inicio != null)&&($cliente_id!=null)&&($user_id==null)){
            $ventas = DB::table('ventas')
                        ->join('clientes', 'ventas.cliente_id', '=','clientes.id')
                        ->join('users', 'ventas.usuario_id', '=', 'users.id')
                        ->where('ventas.fecha_venta','>=',$fecha_inicio)
                        ->where('ventas.fecha_venta','<=',$fecha_fin)
                        ->where('ventas.cliente_id','=',$cliente_id)
                        ->orderBy('ventas.id', 'desc')
                        ->select('ventas.*','clientes.nombre_cliente as cliente', 'users.name as user_name')
                        ->get();
        }
        //busca con fecha cliente y usuarios
        if(($fecha_inicio != null)&&($cliente_id!=null)&&($user_id!=null)){
            $ventas = DB::table('ventas')
                        ->join('clientes', 'ventas.cliente_id', '=','clientes.id')
                        ->join('users', 'ventas.usuario_id', '=', 'users.id')
                        ->where('ventas.fecha_venta','>=',$fecha_inicio)
                        ->where('ventas.fecha_venta','<=',$fecha_fin)
                        ->where('ventas.cliente_id','=',$cliente_id)
                        ->where('ventas.usuario_id', '=', $user_id)
                        ->orderBy('ventas.id', 'desc')
                        ->select('ventas.*','clientes.nombre_cliente as cliente', 'users.name as user_name')
                        ->get();
        }
        //busca con cliente y usuario
        if(($fecha_inicio == null)&&($cliente_id!=null)&&($user_id!=null)){
            $ventas = DB::table('ventas')
                        ->join('clientes', 'ventas.cliente_id', '=','clientes.id')
                        ->join('users', 'ventas.usuario_id', '=', 'users.id')
                        ->where('ventas.cliente_id','=',$cliente_id)
                        ->where('ventas.usuario_id', '=', $user_id)
                        ->orderBy('ventas.id', 'desc')
                        ->select('ventas.*','clientes.nombre_cliente as cliente', 'users.name as user_name')
                        ->get();
        }
        //Busca solo con usuarios
        if(($fecha_inicio == null)&&($cliente_id==null)&&($user_id!=null)){
            $ventas = DB::table('ventas')
                        ->join('clientes', 'ventas.cliente_id', '=','clientes.id')
                        ->join('users', 'ventas.usuario_id', '=', 'users.id')
                        ->where('ventas.usuario_id', '=', $user_id)
                        ->orderBy('ventas.id', 'desc')
                        ->select('ventas.*','clientes.nombre_cliente as cliente', 'users.name as user_name')
                        ->get();
        }
        //Busca solo con cliente
        if(($fecha_inicio == null)&&($cliente_id!=null)&&($user_id==null)){
            $ventas = DB::table('ventas')
                        ->join('clientes', 'ventas.cliente_id', '=','clientes.id')
                        ->join('users', 'ventas.usuario_id', '=', 'users.id')
                        ->where('ventas.cliente_id','=',$cliente_id)
                        ->orderBy('ventas.id', 'desc')
                        ->select('ventas.*','clientes.nombre_cliente as cliente', 'users.name as user_name')
                        ->get();
        }


        //busca fecha con usuario
        if(($fecha_inicio != null)&&($cliente_id==null)&&($user_id!=null)){
            $ventas = DB::table('ventas')
                        ->join('clientes', 'ventas.cliente_id', '=','clientes.id')
                        ->join('users', 'ventas.usuario_id', '=', 'users.id')
                        ->where('ventas.fecha_venta','>=',$fecha_inicio)
                        ->where('ventas.fecha_venta','<=',$fecha_fin)
                        ->where('ventas.usuario_id', '=', $user_id)
                        ->orderBy('ventas.id', 'desc')
                        ->select('ventas.*','clientes.nombre_cliente as cliente', 'users.name as user_name')
                        ->get();
        }

        //todos los registros
        if(($fecha_inicio == null)&&($cliente_id==null)&&($user_id==null)){
            $ventas = DB::table('ventas')
                        ->join('clientes', 'ventas.cliente_id', '=','clientes.id')
                        ->join('users', 'ventas.usuario_id', '=', 'users.id')
                        ->orderBy('ventas.id', 'desc')
                        ->select('ventas.*','clientes.nombre_cliente as cliente','users.name as user_name')
                        ->get();
        }
       //return response()->json(['mensaje'=>'mensaje correcto', 'ventas'=>$ventas]);  
       return view('reportes.ventas_index', ['ventas'=>$ventas, 'fecha_inicio'=>$fecha_inicio, 
                    'fecha_fin'=>$fecha_fin, 'productos'=>$productos, 'clientes'=>$clientes,
                    'users'=>$users, 'cliente_id'=>$cliente_id, 'user_id'=>$user_id]);
    }

    public function destroy($id)
    {
        //
    }
}
