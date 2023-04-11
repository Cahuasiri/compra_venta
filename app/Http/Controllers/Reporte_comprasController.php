<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compra_producto;
use App\Models\Detalle_compra;
use App\Models\Proveedore;
use DateTime;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class Reporte_comprasController extends Controller
{
    public function index()
    {
        $date = new DateTime(); 
        $dt= $date->format('Y-m-d');
        $fecha_inicio = "";
        $fecha_fin = "";

        $proveedor_id = "";
        $user_id = "";

        $proveedores = Proveedore::all();
        $users = User::all();

        //$ventas = Venta::with('cliente')->paginate();
        $compras = DB::table('compra_productos')
                        ->join('proveedores', 'compra_productos.proveedor_id', '=','proveedores.id')
                        ->join('users', 'compra_productos.usuario_id', '=', 'users.id')
                        ->orderBy('compra_productos.id', 'desc')
                        ->select('compra_productos.*','proveedores.nombre as proveedore', 'users.name as user_name')
                        ->get();
        return view('reportes.compras_index', ['compras'=>$compras, 'fecha_inicio'=>$fecha_inicio, 
                    'fecha_fin'=>$fecha_fin,'proveedores'=>$proveedores, 'users'=>$users,
                    'proveedor_id'=>$proveedor_id, 'user_id'=>$user_id]);
    }

    public function create(Request $request)
    {
        
    }

    public function store(Request $request)
    {
        //
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
        
        $date = new DateTime(); 
        $dt= $date->format('Y-m-d');

        $proveedor_id = $request->get('proveedor_id');
        $user_id = $request->get('user_id');

        $proveedores = Proveedore::all();
        $users = User::all();
        
        //busca por fechas
        if(($fecha_inicio != null)&&($proveedor_id==null)&&($user_id==null)){
            $compras = DB::table('compra_productos')
                        ->join('proveedores', 'compra_productos.proveedor_id', '=','proveedores.id')
                        ->join('users', 'compra_productos.usuario_id', '=', 'users.id')
                        ->where('compra_productos.fecha','>=',$fecha_inicio)
                        ->where('compra_productos.fecha','<=',$fecha_fin)
                        ->orderBy('compra_productos.id', 'desc')
                        ->select('compra_productos.*','proveedores.nombre as proveedore', 'users.name as user_name')
                        ->get();
        }
        //busca por fecha y proveedore
        if(($fecha_inicio != null)&&($proveedor_id!=null)&&($user_id==null)){
            $compras = DB::table('compra_productos')
                        ->join('proveedores', 'compra_productos.proveedor_id', '=','proveedores.id')
                        ->join('users', 'compra_productos.usuario_id', '=', 'users.id')
                        ->where('compra_productos.fecha','>=',$fecha_inicio)
                        ->where('compra_productos.fecha','<=',$fecha_fin)
                        ->where('compra_productos.proveedor_id', '=', $proveedor_id)
                        ->orderBy('compra_productos.id', 'desc')
                        ->select('compra_productos.*','proveedores.nombre as proveedore', 'users.name as user_name')
                        ->get();
        }
        //buscar por fecha, proveedore, y usuarios
        if(($fecha_inicio != null)&&($proveedor_id!=null)&&($user_id!=null)){
            $compras = DB::table('compra_productos')
                        ->join('proveedores', 'compra_productos.proveedor_id', '=','proveedores.id')
                        ->join('users', 'compra_productos.usuario_id', '=', 'users.id')
                        ->where('compra_productos.fecha','>=',$fecha_inicio)
                        ->where('compra_productos.fecha','<=',$fecha_fin)
                        ->where('compra_productos.proveedor_id', '=', $proveedor_id)
                        ->where('compra_productos.usuario_id','=',$user_id)
                        ->orderBy('compra_productos.id', 'desc')
                        ->select('compra_productos.*','proveedores.nombre as proveedore', 'users.name as user_name')
                        ->get();
        }
        //busca solo por proveedore y usuario
        if(($fecha_inicio == null)&&($proveedor_id!=null)&&($user_id!=null)){
            $compras = DB::table('compra_productos')
                        ->join('proveedores', 'compra_productos.proveedor_id', '=','proveedores.id')
                        ->join('users', 'compra_productos.usuario_id', '=', 'users.id')
                        ->where('compra_productos.proveedor_id', '=', $proveedor_id)
                        ->where('compra_productos.usuario_id','=',$user_id)
                        ->orderBy('compra_productos.id', 'desc')
                        ->select('compra_productos.*','proveedores.nombre as proveedore', 'users.name as user_name')
                        ->get();
        }
        //buscar solo por usuario
        if(($fecha_inicio == null)&&($proveedor_id==null)&&($user_id!=null)){
            $compras = DB::table('compra_productos')
                        ->join('proveedores', 'compra_productos.proveedor_id', '=','proveedores.id')
                        ->join('users', 'compra_productos.usuario_id', '=', 'users.id')
                        ->where('compra_productos.usuario_id','=',$user_id)
                        ->orderBy('compra_productos.id', 'desc')
                        ->select('compra_productos.*','proveedores.nombre as proveedore', 'users.name as user_name')
                        ->get();
        }
        //buscar solo por proveedore
        if(($fecha_inicio == null)&&($proveedor_id!=null)&&($user_id==null)){
            $compras = DB::table('compra_productos')
                        ->join('proveedores', 'compra_productos.proveedor_id', '=','proveedores.id')
                        ->join('users', 'compra_productos.usuario_id', '=', 'users.id')
                        ->where('compra_productos.proveedor_id', '=', $proveedor_id)
                        ->orderBy('compra_productos.id', 'desc')
                        ->select('compra_productos.*','proveedores.nombre as proveedore', 'users.name as user_name')
                        ->get();
        }
        //buscar por fecha y usuario
        if(($fecha_inicio != null)&&($proveedor_id==null)&&($user_id!=null)){
             $compras = DB::table('compra_productos')
                        ->join('proveedores', 'compra_productos.proveedor_id', '=','proveedores.id')
                        ->join('users', 'compra_productos.usuario_id', '=', 'users.id')
                        ->where('compra_productos.fecha','>=',$fecha_inicio)
                        ->where('compra_productos.fecha','<=',$fecha_fin)
                        ->where('compra_productos.usuario_id','=',$user_id)
                        ->orderBy('compra_productos.id', 'desc')
                        ->select('compra_productos.*','proveedores.nombre as proveedore', 'users.name as user_name')
                        ->get();
        }
        //buscar todos
        if(($fecha_inicio == null)&&($proveedor_id==null)&&($user_id==null)){
             $compras = DB::table('compra_productos')
                        ->join('proveedores', 'compra_productos.proveedor_id', '=','proveedores.id')
                        ->join('users', 'compra_productos.usuario_id', '=', 'users.id')
                        ->orderBy('compra_productos.id', 'desc')
                        ->select('compra_productos.*','proveedores.nombre as proveedore', 'users.name as user_name')
                        ->get();     

        }

       return view('reportes.compras_index', ['compras'=>$compras, 'fecha_inicio'=>$fecha_inicio, 
                    'fecha_fin'=>$fecha_fin, 'proveedores'=>$proveedores, 'users'=>$users,
                    'proveedor_id'=>$proveedor_id, 'user_id'=>$user_id]);
    }

    public function destroy($id)
    {
        //
    }
}
