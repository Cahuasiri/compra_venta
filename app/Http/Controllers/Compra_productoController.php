<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Detalle_compra;
use App\Models\Producto;
use App\Models\Proveedore;
use App\Models\Almacene;
use App\Models\Compra_producto;
use App\Models\Tipo_pago;
use DateTime;
use Date;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Unidad_producto;
use App\Models\Sub_categoria;
use PDF;


class Compra_productoController extends Controller
{

    public function index()
    {   
        $compras = DB::table('compra_productos')
                        ->JOIN('proveedores','compra_productos.proveedor_id', '=', 'proveedores.id')
                        ->JOIN('tipo_pagos', 'compra_productos.tipo_pago_id', '=', 'tipo_pagos.id')
                        ->select('compra_productos.*','proveedores.nombre as proveedor', 'tipo_pagos.nombre as tipo_pago')
                        ->orderBy('compra_productos.id','desc')
                        ->get();

        return view('compra_productos.index',['compras'=>$compras]);
    }

    public function create(Request $request)    {   
       
         $proveedores = Proveedore::all();
         $productos = Producto::where('estado','A')->get();
         $almacenes = Almacene::all();
         $tipo_pagos = Tipo_pago::all();

         //para crear un nuevo producto
         $categorias = Categoria::all();
         $marcas     = Marca::all();
         $sub_categorias = Sub_categoria::all();
         $unidad_productos = Unidad_producto::all();

         $date = new DateTime(); // Date object using current date and time
         $dt= $date->format('Y-m-d\TH:i:s'); 

        return view('compra_productos.create', ['productos'=>$productos, 'proveedores'=>$proveedores,
                     'almacenes'=>$almacenes,'dt'=>$dt,'tipo_pagos'=>$tipo_pagos,
                     'categorias'=>$categorias,
                     'marcas'=>$marcas, 'sub_categorias'=>$sub_categorias,
                     'unidad_productos'=>$unidad_productos]);
    }

    public function store(Request $request)
    {   
        $compra_producto = new Compra_producto();
        $compra_producto->fecha = $request->get('fecha_compra');
        $compra_producto->referencia = $request->get('referencia');
        $compra_producto->proveedor_id = $request->get('proveedor_id');
        $compra_producto->almacen_id = $request->get('almacen_id');
        $compra_producto->tipo_pago_id = $request->get('tipo_pago_id');
        $compra_producto->descripcion = $request->get('descripcion');

        $producto_id = $request->get('product_id');
        $cantidad = $request->get('cantidad');
        $costo = $request->get('costo');
        $precio = $request->get('precio');

        //calcular el costo total provisional
        if($producto_id != null){
            $costo_total = 0;
            for($i=0; $i < count($producto_id); $i++){
                $costo_total = $costo_total + $cantidad[$i]*$costo[$i];
            }
            $compra_producto->costo_total = $costo_total; 
            //Guardar Producto en la tabla
            $compra_producto->save();
        }

        //buscar la ultima compra ingresado
        $ultimaCompra = Compra_producto::latest()->first();
        $compra_id = $ultimaCompra->id;

        if($producto_id != null){
           
            for($i=0; $i < count($producto_id); $i++){                
                $detalle_productos = new Detalle_compra();
                
                $detalle_productos->compra_producto_id = $compra_id;
                $detalle_productos->producto_id = $producto_id[$i];
                $detalle_productos->costoCompra = $costo[$i];
                $detalle_productos->costoVenta = $precio[$i];
                $detalle_productos->cantidad = $cantidad[$i];

                $detalle_productos->save();

                //Update de el stock de la tabla productos
                $producto = Producto::find($producto_id[$i]);
                $stock = $producto->stock + $cantidad[$i];               
                $update = Producto::where('id', '=', $producto_id[$i])->update(['stock'=>$stock]);
            }
        }     

        //buscar para imprimir
        $detalle_compras = Detalle_compra::JOIN('productos','productos.id','=','detalle_compras.producto_id')
                                        ->where('compra_producto_id', $compra_id)
                                        ->get();
        $proveedore = Proveedore::find($compra_producto->proveedor_id);
       return view('compra_productos.recibo', ['ultimaCompra'=>$ultimaCompra, 'detalle_compras'=>$detalle_compras, 'proveedore'=>$proveedore]);

      // return view('compra_productos.recibo');
    }

    public function show($id)
    {
        //buscar para imprimir
        $compraProducto = Compra_producto::find($id);
        $detalle_compras = Detalle_compra::JOIN('productos','productos.id','=','detalle_compras.producto_id')
                                        ->where('compra_producto_id', $id)
                                        ->get();
        $proveedore = Proveedore::find($compraProducto->proveedor_id);
       return view('compra_productos.recibo', ['ultimaCompra'=>$compraProducto, 'detalle_compras'=>$detalle_compras, 'proveedore'=>$proveedore]);
    }

    public function edit($id)
    {   
        $proveedores = Proveedore::all();
        $productos = Producto::where('estado','A')->get();
        $almacenes = Almacene::all();
        $compras = Compra_producto::find($id);
        $tipo_pagos = Tipo_pago::all();
        $detalle_productos = Detalle_compra::JOIN('productos','detalle_compras.producto_id','=','productos.id')
                                                        ->where('detalle_compras.compra_producto_id',$id)
                                                        ->orderBy('detalle_compras.id', 'asc')
                                                        ->get(['detalle_compras.*','productos.nombre_producto']);
        //dd($detalle_productos);
        return view('compra_productos.edit', ['proveedores'=>$proveedores, 'productos'=>$productos, 'almacenes'=>$almacenes, 'compras'=>$compras, 'detalle_productos'=>$detalle_productos, 'tipo_pagos'=>$tipo_pagos]);
    }

    public function update(Request $request, $id)
    {
        $compra_producto = Compra_producto::find($id);
        $compra_producto->fecha = $request->get('fecha_compra');
        $compra_producto->referencia = $request->get('referencia');
        $compra_producto->proveedor_id = $request->get('proveedor_id');
        $compra_producto->almacen_id = $request->get('almacen_id');
        $compra_producto->tipo_pago_id = $request->get('tipo_pago_id');
        $compra_producto->descripcion = $request->get('descripcion');

        $producto_id = $request->get('product_id');
        $cantidad = $request->get('cantidad');
        $costo = $request->get('costo');
        $precio = $request->get('precio');

        //calcular el costo total provisional costo = a cueanto estoy comprando y precio a cuanto vender
        if($producto_id != null){
            $costo_total = 0;
            for($i=0; $i < count($producto_id); $i++){
                $costo_total = $costo_total + $cantidad[$i]*$costo[$i];
            }
            $compra_producto->costo_total = $costo_total; 
            //Guardar Producto en la tabla
            $compra_producto->save();
        }

        //buscar la ultima compra ingresado
       
        $detalle_producto_id = $request->get('detalle_producto_id');
        if($detalle_producto_id != null){
           
            for($i=0; $i < count($detalle_producto_id); $i++){
                //buscar los datos antes de modificar
                $detalle_productos = Detalle_compra::find($detalle_producto_id[$i]);
                $cantidad_ant = $detalle_productos->cantidad;
                
                $detalle_productos->compra_producto_id = $id;
                $detalle_productos->producto_id = $producto_id[$i];
                $detalle_productos->costoCompra = $costo[$i];
                $detalle_productos->costoVenta = $precio[$i];
                $detalle_productos->cantidad = $cantidad[$i];

                $detalle_productos->save();

                //Update de el stock de la tabla productos
                $producto = Producto::find($producto_id[$i]);
                $stock = $producto->stock -$cantidad_ant + $cantidad[$i];               
                $update = Producto::where('id', '=', $producto_id[$i])->update(['stock'=>$stock]);
            }
        }     

        //buscar para imprimir
        $compraProducto = Compra_producto::find($id);
        $detalle_compras = Detalle_compra::JOIN('productos','productos.id','=','detalle_compras.producto_id')
                                        ->where('compra_producto_id', $id)
                                        ->get();
        $proveedore = Proveedore::find($compra_producto->proveedor_id);
       return view('compra_productos.recibo', ['ultimaCompra'=>$compraProducto, 'detalle_compras'=>$detalle_compras, 'proveedore'=>$proveedore]);
       //return redirect('compra_productos');
    }

    public function destroy($id)
    {
        $detalle_compras = Detalle_compra::where('compra_producto_id',$id);
        $detalle_compras->delete();

        $compra = Compra_producto::find($id);
        $compra->delete();

        //actualizar stock de la tabla productos

        return redirect('compra_productos');
    }

    public function search(Request $request){
        
        $search = $request->search;
        if($search == ""){
            $proveedores = Proveedore::where('estado','A')->limit(5)->get(); 
        }
        else{
            $proveedores = Proveedore::where('nombre','LIKE','%'.$search.'%')->get();
        }
        $response = array();
        foreach($proveedores as $proveedor){
            $response[] = array(
                'id'=>$proveedor->id,
                'text'=>$proveedor->nombre
            );
        }

        return response()->json($response);
    }

    public function bproducto($id){
        $id = $_GET['id'];
        $producto = Producto::find($id); 
        //dd($producto);            
        return response()->json(['mensaje'=>'mensaje correcto','producto'=>$producto]);      
    }

    public function generarPDF($id){
        //buscar para imprimir

        ini_set('memory_limit', '-1');
        $compraProducto = Compra_producto::find($id);
        $detalle_compras = Detalle_compra::JOIN('productos','productos.id','=','detalle_compras.producto_id')
                                        ->where('compra_producto_id', $id)
                                        ->get();
        $proveedore = Proveedore::find($compraProducto->proveedor_id);

        $pdf = PDF::loadView('compra_productos.recibo_pdf', ['ultimaCompra'=>$compraProducto, 'detalle_compras'=>$detalle_compras, 'proveedore'=>$proveedore]);    
        return $pdf->download('demo.pdf');

        //return view();
    }
}
