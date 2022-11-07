<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Detalle_ingreso_producto;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Producto;
use App\Models\Proveedore;
use App\Models\Variante_producto;

class Ver_detalle_productoController extends Controller
{
    public function index()
    {
        $productos = Producto::where('estado','A')->get();
        return view('ver_productos.index', ['productos'=>$productos]);
    }

    public function create(Request $request)
    {
        $_productos = Producto::where('estado','A')->get();

        $id = $request->get('producto_id');        
        $producto = Producto::with('categoria','marca')->find($id);

        //buscamos id del preveedor en la tabla detalle-producto con id del producto       
        $detalleProducto = DB::table('proveedores')
                                    ->join('detalle_ingreso_productos', 'proveedores.id', '=','detalle_ingreso_productos.proveedor_id') 
                                    ->where('detalle_ingreso_productos.producto_id','=',$id)
                                    ->get(); 

        //buscamos los variantes del producto
        $variante_producto = Variante_producto::where('producto_id',$id)->get();
        
        return view('ver_productos.show', ['producto'=>$producto, 'detalleProducto'=>$detalleProducto, 'variante_producto'=>$variante_producto, '_productos'=>$_productos]);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Request $request,$id)
    {
        dd('hola');
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
