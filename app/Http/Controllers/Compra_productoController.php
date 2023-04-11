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
use App\Models\Datos_empresa;
use App\Models\Pago_de_Credito;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
         $datos_empresa = Datos_empresa::find(1);
         //para crear un nuevo producto
         $categorias = Categoria::all();
         $marcas     = Marca::all();
         $sub_categorias = Sub_categoria::all();
         $unidad_productos = Unidad_producto::all();
         
         //sacar compra referencia para incrementar en 1
         $compra = Compra_producto::orderBy('referencia','desc')->limit(1)->get();
         //dd($compra[0]['referencia']);
         if(empty($compra) || ($compra[0]['referencia'])){
            $referencia = $compra[0]['referencia'];
            $newReferencia = $referencia +1;
           // dd("entro");
         }
         else{
            $newReferencia = $datos_empresa->compra_referencia;
         }
         

         //saca la fecha
         $date = new DateTime(); // Date object using current date and time
         $dt= $date->format('Y-m-d'); 

        return view('compra_productos.create', ['productos'=>$productos, 'proveedores'=>$proveedores,
                     'almacenes'=>$almacenes,'dt'=>$dt,'tipo_pagos'=>$tipo_pagos,
                     'categorias'=>$categorias,
                     'marcas'=>$marcas, 'sub_categorias'=>$sub_categorias,
                     'unidad_productos'=>$unidad_productos,'datos_empresa'=>$datos_empresa,
                     'referencia'=>$newReferencia]);
    }

    public function store(Request $request)
    {   
        $compra_producto = new Compra_producto();
        $datos_empresa = Datos_empresa::find(1);
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

       $compra_producto->sub_total = $request->get('sub_total');
       $compra_producto->total = $request->get('total');
       $compra_producto->descuento = $request->get('descuento_mo');

       // si la opcion es efectivo
       if($compra_producto->tipo_pago_id == 1){
            $compra_producto->monto_pagado = $request->get('total');
       }
      
       //registrar si existe nro de Bancp
       if($request->get('nro_banco') != null){
            $compra_producto->nro_banco = $request->get('nro_banco');
            $compra_producto->monto_pagado = $request->get('total');
       }
       //registrar si existe nro- Cheque
       if($request->get('nro_cheque') != null){
            $compra_producto->nro_cheque = $request->get('nro_cheque');
            $compra_producto->monto_pagado = $request->get('total');
       }
       //registrar si existe si xiste fecha limite
       if($request->get('fecha_limite') != null){
            $compra_producto->fecha_limite_pago = $request->get('fecha_limite');
       }
       //usuario
       $usuario_id = Auth::id();
       $compra_producto->usuario_id = $usuario_id;

       //Guardar los datos en la BD
       $compra_producto->save();

        //buscar la ultima compra ingresado
        $ultimaCompra = Compra_producto::latest()->first();
        $compra_id = $ultimaCompra->id;
        //sacar usuario de compra
        $user = User::find($ultimaCompra->usuario_id);

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
       return view('compra_productos.recibo', ['ultimaCompra'=>$ultimaCompra, 'detalle_compras'=>$detalle_compras, 
                                            'proveedore'=>$proveedore, 
                                            'datos_empresa'=>$datos_empresa,
                                            'user_name'=>$user->name]);

      // return view('compra_productos.recibo');
    }

    public function show($id)
    {
        //buscar para imprimir
        $compraProducto = Compra_producto::find($id);
        $datos_empresa = Datos_empresa::find(1);
        $detalle_compras = Detalle_compra::JOIN('productos','productos.id','=','detalle_compras.producto_id')
                                        ->where('compra_producto_id', $id)
                                        ->get();
        $proveedore = Proveedore::find($compraProducto->proveedor_id);
        $user = User::find($compraProducto->usuario_id);
       return view('compra_productos.recibo', ['ultimaCompra'=>$compraProducto, 'detalle_compras'=>$detalle_compras, 
                'proveedore'=>$proveedore, 'datos_empresa'=>$datos_empresa, 'user_name'=>$user->name]);
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
        $datos_empresa = Datos_empresa::find(1);

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

        $compra_producto->sub_total = $request->get('sub_total');
        $compra_producto->total = $request->get('total');
        $compra_producto->descuento = $request->get('descuento_mo');

        // si la opcion es efectivo
        if($compra_producto->tipo_pago_id == 1){
             $compra_producto->monto_pagado = $request->get('total');
        }
       
        //registrar si existe nro de Bancp
        if($request->get('nro_banco') != null){
             $compra_producto->nro_banco = $request->get('nro_banco');
             $compra_producto->monto_pagado = $request->get('total');
        }
        //registrar si existe nro- Cheque
        if($request->get('nro_cheque') != null){
             $compra_producto->nro_cheque = $request->get('nro_cheque');
             $compra_producto->monto_pagado = $request->get('total');
        }
        //registrar si existe si xiste fecha limite
        if($request->get('fecha_limite') != null){
             $compra_producto->fecha_limite_pago = $request->get('fecha_limite');
        }

            //Guardar los datos en la BD
            $compra_producto->save();

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
        $user = User::find($compraProducto->usuario_id);
        //dd($user->name);
        $detalle_compras = Detalle_compra::JOIN('productos','productos.id','=','detalle_compras.producto_id')
                                        ->where('compra_producto_id', $id)
                                        ->get();
        $proveedore = Proveedore::find($compra_producto->proveedor_id);
       return view('compra_productos.recibo', ['ultimaCompra'=>$compraProducto, 'detalle_compras'=>$detalle_compras, 
                        'proveedore'=>$proveedore, 'datos_empresa'=>$datos_empresa,
                        'user_name'=>$user->name]);
       //return redirect('compra_productos');
    }

    public function destroy($id)
    {
        $pago_credito = DB::table('pago_de_creditos')->where('compra_id',$id)->get();
        $registros= count($pago_credito);
        if($registros >= '1'){
            return redirect('compra_productos')->with('eliminar', 'no');
        }
        else{
            $detalle_compras = Detalle_compra::where('compra_producto_id',$id);
            $detalle_compras->delete();
            $compra = Compra_producto::find($id);
            $compra->delete();
            return redirect('compra_productos')->with('eliminar', 'ok');
        }
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
    public function registrar_pago(Request $request, $id){

        $compra_id = $request->get('compra_id');
        $monto_a_pagar = $request->get('monto_a_pagar');
        $fecha_pago = $request->get('fecha_pago');

        $pagoCredito = new Pago_de_credito();

        $pagoCredito->compra_id = $compra_id;
        $pagoCredito->monto = $monto_a_pagar;
        $pagoCredito->fecha_pago = $fecha_pago;

        $pagoCredito->save();

        $compra = Compra_producto::find($compra_id);
        $suma_monto = $compra->monto_pagado + $monto_a_pagar;
        $compra->monto_pagado = $suma_monto;

        $compra->save();

        return redirect('compra_productos');
    }
}
