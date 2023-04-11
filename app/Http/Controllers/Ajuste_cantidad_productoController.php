<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class Ajuste_cantidad_productoController extends Controller
{

    public function index()
    {
        $productos = Producto::with('categoria','marca','unidad_producto')->where('estado','=','A')->paginate();
        return view ('productos.ajuste_cantidad', ['productos'=>$productos]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $id = $request->get('producto_id_');
        $stock = $request->get('stock');
        //dd($stock);

        $producto = Producto::find($id);
        //dd($producto);
        $producto->stock = $stock;
        $producto->save();

        return redirect('productos')->with('message','Guardado correctamente');
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
        $stock = "gf";
        $id = "1";

       // $producto = Producto::find($id);
          $productos = Producto::all();
        // $producto->stock = $stock;
        // $producto->save();
        //dd($producto);
        $resp = [
            "stock"=>"45",
            "id"   =>"1",
        ];
        return response()->json(['mensaje'=>'Stock se ha modificado','productos'=>$productos]);   
    }

    public function destroy($id)
    {
        //
    }
}
