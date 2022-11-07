<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cotizacione;
use App\Models\Detalle_cotizacione;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Grupo_cliente;
use DateTime;

class CotizacioneController extends Controller
{
    public function index()
    {
       // $cotizaciones = Cotizacione::all();
        $cotizaciones = Cotizacione::with('cliente')->paginate();

        return view('cotizaciones.index',['cotizaciones'=>$cotizaciones]);
    }

    public function create()
    {
        $clientes = Cliente::all();
        $productos = Producto::where('estado','A')->get();
        $grupo_clientes = Grupo_cliente::all();       
       
        $date = new DateTime(); // Date object using current date and time
        $dt= $date->format('Y-m-d\TH:i:s'); 
       
       return view('cotizaciones.create', ['productos'=>$productos, 'clientes'=>$clientes, 'dt'=>$dt, 'grupo_clientes'=>$grupo_clientes]);
    }

    public function store(Request $request)
    {
        $cotizacion= new Cotizacione();
        $cotizacion->fecha_cotizacion = $request->get('fecha_cotizacion');
        $cotizacion->referencia = $request->get('referencia');
        $cotizacion->cliente_id = $request->get('cliente_id');
        $cotizacion->descuento_porcentaje = $request->get('descuento_porcentaje');

        if($request->get('descuento_porcentaje') > 0){
            $monto_descuento = $request->get('sub_total')*$request->get('descuento_porcentaje')/100;
        }
        else{
            $monto_descuento = 0;
        }
        $cotizacion->descuento = $monto_descuento;
        $cotizacion->impuesto = $request->get('impuesto');

        $cotizacion->sub_total = $request->get('sub_total');
        $cotizacion->total = $request->get('total');
        $cotizacion->descripcion = $request->get('descripcion');

        $producto_id = $request->get('product_id');
        $cantidad = $request->get('cantidad');
        $precio_unitario = $request->get('precio_unitario');
       
        //guardar venta en la base de datos
        $cotizacion->save();

        //buscar la ultima venta ingresado
        $ultimaCotizacion = Cotizacione::latest()->first();
        $cotizacion_id = $ultimaCotizacion->id;

        if($producto_id != null){
           
            for($i=0; $i < count($producto_id); $i++){                
                $detalle_cotizacion= new Detalle_cotizacione();
                
                $detalle_cotizacion->cotizacion_id = $cotizacion_id;
                $detalle_cotizacion->producto_id = $producto_id[$i];
                $detalle_cotizacion->precio_unitario = $precio_unitario[$i];
                $detalle_cotizacion->cantidad = $cantidad[$i];

                $detalle_cotizacion->save();
            }
        }     

        //buscar para imprimir
        $detalle_cotizaciones = Detalle_cotizacione::JOIN('productos','productos.id','=','detalle_cotizaciones.producto_id')
                                        ->where('cotizacion_id', $cotizacion_id)
                                        ->get();
        $cliente = Cliente::find($cotizacion->cliente_id);
       return view('cotizaciones.recibo', ['ultimaCotizacion'=>$ultimaCotizacion, 'detalle_cotizaciones'=>$detalle_cotizaciones, 'cliente'=>$cliente]);
      // return redirect('cotizaciones');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $clientes = Cliente::all();
        $productos = Producto::where('estado','A')->get();
        $cotizacion = Cotizacione::find($id);
        $grupo_clientes = Grupo_cliente::all(); 
        $detalle_cotizaciones = Detalle_cotizacione::JOIN('productos','detalle_cotizaciones.producto_id','=','productos.id')
                                        ->where('detalle_cotizaciones.cotizacion_id',$id)
                                        ->orderBy('detalle_cotizaciones.id', 'asc')
                                        ->get(['detalle_cotizaciones.*','productos.nombre_producto']);
        //dd($detalle_productos);
        return view('cotizaciones.edit', ['clientes'=>$clientes, 'productos'=>$productos,  'cotizacion'=>$cotizacion, 'detalle_cotizaciones'=>$detalle_cotizaciones, 'grupo_clientes'=>$grupo_clientes]);
    }

    public function update(Request $request, $id)
    {
        $cotizacion= Cotizacione::find($id);
        $cotizacion->fecha_cotizacion = $request->get('fecha_cotizacion');
        $cotizacion->referencia = $request->get('referencia');
        $cotizacion->cliente_id = $request->get('cliente_id');
        $cotizacion->descuento_porcentaje = $request->get('descuento_porcentaje');

        if($request->get('descuento_porcentaje') > 0){
            $monto_descuento = $request->get('sub_total')*$request->get('descuento_porcentaje')/100;
        }
        else{
            $monto_descuento = 0;
        }
        $cotizacion->descuento = $monto_descuento;
        $cotizacion->impuesto = $request->get('impuesto');

        $cotizacion->sub_total = $request->get('sub_total');
        $cotizacion->total = $request->get('total');
        $cotizacion->descripcion = $request->get('descripcion');

        $producto_id = $request->get('product_id');
        $cantidad = $request->get('cantidad');
        $precio_unitario = $request->get('precio_unitario');
       
        //guardar cotizacion en la base de datos
        $cotizacion->save();

        //buscar la ultima venta ingresado
        $detalle_cotizacion_id = $request->get('detalle_cotizacion_id');

        if($detalle_cotizacion_id != null){
           
            for($i=0; $i < count($detalle_cotizacion_id); $i++){                
                $detalle_cotizacion= Detalle_cotizacione::find($detalle_cotizacion_id[$i]);
                
                //$detalle_cotizacion->cotizacion_id = $cotizacion_id;
                $detalle_cotizacion->producto_id = $producto_id[$i];
                $detalle_cotizacion->precio_unitario = $precio_unitario[$i];
                $detalle_cotizacion->cantidad = $cantidad[$i];

                $detalle_cotizacion->save();
            }
        }     

        //buscar para imprimir
        $cotizacion = Cotizacione::find($id);
        $detalle_cotizaciones = Detalle_cotizacione::JOIN('productos','productos.id','=','detalle_cotizaciones.producto_id')
                                        ->where('cotizacion_id', $id)
                                        ->get();
        $cliente = Cliente::find($cotizacion->cliente_id);
       return view('cotizaciones.recibo', ['ultimaCotizacion'=>$cotizacion, 'detalle_cotizaciones'=>$detalle_cotizaciones, 'cliente'=>$cliente]);
       //return redirect('cotizaciones');
    }

    public function destroy($id)
    {
        $detalle_cotizaciones = Detalle_cotizacione::where('cotizacion_id',$id);
        $detalle_cotizaciones->delete();

        $cotizacion = Cotizacione::find($id);
        $cotizacion->delete();

        return redirect('cotizaciones');
    }
}
