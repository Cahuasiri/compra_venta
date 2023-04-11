<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Venta;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Metodo_Pago;
use App\Models\Detalle_venta;
use App\Models\Grupo_cliente;
use DateTime;
use App\Models\Datos_empresa;
use App\Models\Detalle_compra;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class VentaController extends Controller
{

    public function index()
    {

        $ventas = DB::table('ventas')
                        ->JOIN('clientes','ventas.cliente_id', '=', 'clientes.id')
                        ->JOIN('metodo_pagos', 'ventas.metodo_pago_id', '=', 'metodo_pagos.id')
                        ->select('ventas.*','clientes.nombre_cliente as cliente', 'metodo_pagos.nombre_pago as metodo_pago')
                        ->orderBy('ventas.id','desc')
                        ->get();

        return view('ventas.index', ['ventas'=>$ventas]);
    }

    public function create()
    {
        
        $clientes = Cliente::all();
        $productos = Producto::where('estado','A')->get();       
        $metodo_pagos = Metodo_pago::all();        
        $grupo_clientes = Grupo_cliente::all();
        $datos_empresa = Datos_empresa::find(1);
        
        //sacar ventareferencia para incrementar en 1
        $venta = Venta::orderBy('nro_referencia','desc')->limit(1)->get();
        if(empty($venta)){
            $referencia = $venta[0]['nro_referencia'];
            $newReferencia = $referencia +1;
        }
        else{
            $newReferencia = $datos_empresa->venta_referencia;
        }

        $venta = Venta::orderBy('nro_factura','desc')->limit(1)->get();
        if(empty($venta)){
            $nro_factura = $venta[0]['nro_factura'];
            $newFactura = $nro_factura +1; 
        }
        else{
            $newFactura = ""; 
        }
       

        $date = new DateTime(); // Date object using current date and time
        $dt= $date->format('Y-m-d\TH:i:s'); 
       
       return view('ventas.create', ['productos'=>$productos, 'clientes'=>$clientes, 'dt'=>$dt, 
                    'metodo_pagos'=>$metodo_pagos, 'grupo_clientes'=>$grupo_clientes, 
                    'datos_empresa'=>$datos_empresa,
                    'nro_referencia'=>$newReferencia,
                    'nro_factura'=>$newFactura]);
      // return view('ventas.recibo');
    }

    public function store(Request $request)
    {
        $venta = new Venta();
        $venta->fecha_venta = $request->get('fecha_venta');
        $venta->nro_referencia = $request->get('nro_referencia');
        $venta->nro_factura = $request->get('nro_factura');
        $venta->cliente_id = $request->get('cliente_id');
        $venta->impuesto = $request->get('impuesto');
        $venta->sub_total = $request->get('sub_total');
        $venta->descuento_porcentaje = $request->get('descuento_porcentaje');
        $descuento = ($request->get('sub_total'))*($request->get('descuento_porcentaje'))/100;
        $venta->descuento = $descuento;
        $venta->total = $request->get('total');
        $venta->metodo_pago_id = $request->get('metodo_pago_id');

        $producto_id = $request->get('product_id');
        $cantidad = $request->get('cantidad');
        $precio_unitario = $request->get('precio_unitario');

        //usuario
        $usuario_id = Auth::id();
        $venta->usuario_id = $usuario_id;
       
        //guardar venta en la base de datos
        $venta->save();

        //buscar la ultima venta ingresado
        $ultimaVenta = Venta::latest()->first();
        $venta_id = $ultimaVenta->id;

        //sacar usuario de venta
        $user = User::find($ultimaVenta->usuario_id);

        if($producto_id != null){
           
            for($i=0; $i < count($producto_id); $i++){                
                $detalle_venta= new Detalle_venta();
                
                $detalle_venta->venta_id = $venta_id;
                $detalle_venta->producto_id = $producto_id[$i];
                $detalle_venta->precio_unitario = $precio_unitario[$i];
                $detalle_venta->cantidad = $cantidad[$i];

                $detalle_venta->save();

                //Update de el stock de la tabla productos
                $producto = Producto::find($producto_id[$i]);
                $stock = $producto->stock - $cantidad[$i];               
                $update = Producto::where('id', '=', $producto_id[$i])->update(['stock'=>$stock]);
            }
        }     
        //buscar para imprimir
        $detalle_ventas = Detalle_venta::JOIN('productos','productos.id','=','detalle_ventas.producto_id')
                                        ->where('venta_id', $venta_id)
                                        ->get();
        $cliente = Cliente::find($venta->cliente_id);
        $datos_empresa = Datos_empresa::find(1);
       return view('ventas.recibo', ['ultimaVenta'=>$ultimaVenta, 'detalle_ventas'=>$detalle_ventas, 
                                'cliente'=>$cliente,
                                'datos_empresa'=>$datos_empresa,
                                'user_name'=>$user->name]);
    }

    public function show($id)
    {
        //buscar para imprimir
        $venta = Venta::find($id);
        $detalle_ventas = Detalle_venta::JOIN('productos','productos.id','=','detalle_ventas.producto_id')
                                        ->where('venta_id', $id)
                                        ->get();
        $cliente = Cliente::find($venta->cliente_id);
        $user = User::find($venta->usuario_id);
        $datos_empresa = Datos_empresa::find(1);
       return view('ventas.recibo', ['ultimaVenta'=>$venta, 'detalle_ventas'=>$detalle_ventas, 
       'cliente'=>$cliente, 'datos_empresa'=>$datos_empresa,'user_name'=>$user->name]);
    }

    public function edit($id)
    {
        $clientes = Cliente::all();
        $productos = Producto::where('estado','A')->get();
        $venta = Venta::find($id);
        $metodo_pagos = Metodo_pago::all();
        $grupo_clientes = Grupo_cliente::all();
        $detalle_ventas = Detalle_venta::JOIN('productos','detalle_ventas.producto_id','=','productos.id')
                                        ->where('detalle_ventas.venta_id',$id)
                                        ->orderBy('detalle_ventas.id', 'asc')
                                        ->get(['detalle_ventas.*','productos.nombre_producto', 'productos.barCodigo']);
        //dd($detalle_productos);
        return view('ventas.edit', ['clientes'=>$clientes, 'productos'=>$productos,  'venta'=>$venta, 'detalle_ventas'=>$detalle_ventas, 'metodo_pagos'=>$metodo_pagos, 'grupo_clientes'=>$grupo_clientes]);
    }

    public function update(Request $request, $id)
    {
        $venta = Venta::find($id);
        $venta->fecha_venta = $request->get('fecha_venta');
        $venta->nro_referencia = $request->get('nro_referencia');
        $venta->nro_factura = $request->get('nro_factura');
        $venta->cliente_id = $request->get('cliente_id');
        $venta->impuesto = $request->get('impuesto');
        $venta->sub_total = $request->get('sub_total');
        $venta->descuento_porcentaje = $request->get('descuento_porcentaje');
        $descuento = ($request->get('sub_total'))*($request->get('descuento_porcentaje'))/100;
        $venta->descuento = $descuento;
        $venta->total = $request->get('total');
        $venta->metodo_pago_id = $request->get('metodo_pago_id');

        $producto_id = $request->get('product_id');
        $cantidad = $request->get('cantidad');
        $precio_unitario = $request->get('precio_unitario');
       
        //guardar venta en la base de datos
        $venta->save();

        $detalle_venta_id = $request->get('detalle_venta_id');
        
        if($detalle_venta_id != null){
           
            for($i=0; $i < count($detalle_venta_id); $i++){ 

                $detalle_venta= Detalle_venta::find($detalle_venta_id[$i]);
                $cantidad_ant = $detalle_venta->cantidad;
                
                $detalle_venta->venta_id = $id;
                $detalle_venta->producto_id = $producto_id[$i];
                $detalle_venta->precio_unitario = $precio_unitario[$i];
                $detalle_venta->cantidad = $cantidad[$i];

                $detalle_venta->save();

                //Update de el stock de la tabla productos
                $producto = Producto::find($producto_id[$i]);
                $stock = $producto->stock + $cantidad_ant - $cantidad[$i];               
                $update = Producto::where('id', '=', $producto_id[$i])->update(['stock'=>$stock]);
            }
        }     
        //buscar para imprimir
        $venta = Venta::find($id);
        $user = User::find($venta->usuario_id);
        $detalle_ventas = Detalle_venta::JOIN('productos','productos.id','=','detalle_ventas.producto_id')
                                        ->where('venta_id', $id)
                                        ->get();
        $cliente = Cliente::find($venta->cliente_id);
        $datos_empresa = Datos_empresa::find(1);
       return view('ventas.recibo', ['ultimaVenta'=>$venta, 'detalle_ventas'=>$detalle_ventas, 
                                'cliente'=>$cliente, 'datos_empresa'=>$datos_empresa,
                                'user_name'=>$user->name]);
       //return redirect('ventas');
    }

    public function destroy($id)
    {   
        $detalle_ventas = Detalle_venta::where('venta_id',$id);
        $detalle_ventas->delete();

        $venta = Venta::find($id);
        $venta->delete();

        return redirect('ventas')->with('eliminar', 'ok');
    }

    public function search(Request $request){
        
        $search = $request->search;
        if($search == ""){
            $clientes = Cliente::all(); 
        }
        else{
            $clientes = Cliente::where('nombre_cliente','LIKE','%'.$search.'%')->get();
        }
        $response = array();
        foreach($clientes as $cliente){
            $response[] = array(
                'id'=>$cliente->id,
                'text'=>$cliente->nombre_cliente
            );
        }

        return response()->json($response);
    }

    public function bproducto($id){
        $id = $_GET['id'];

        $detalle_compras = Detalle_compra::where('producto_id',$id)->get();
        $cant = count($detalle_compras);

        if($cant > 0){
            $producto = DB::table('productos')
                            ->JOIN('detalle_compras','productos.id','=','detalle_compras.producto_id')
                            ->select('productos.*','detalle_compras.costoVenta')
                            ->where('productos.id',$id)
                            ->orderBy('detalle_compras.id','desc')
                            ->latest()->first();
            //dd($producto);                    
            return response()->json(['mensaje'=>'mensaje correcto','producto'=>$producto]);
        }
        else{
            $producto = Producto::find($id);
            return response()->json(['mensaje'=>'incorrecto', 'producto'=>$producto]);
        }      
    }
}
