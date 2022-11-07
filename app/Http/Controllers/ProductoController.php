<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Proveedore;
use App\Models\Detalle_compra;
use App\Models\Detalle_venta;
use App\Models\Variante_producto;
use App\Models\Unidad_producto;
use App\Models\Sub_categoria;

class ProductoController extends Controller
{
    
    public function index()
    {
        $productos = Producto::with('categoria','marca','unidad_producto')->where('estado','=','A')->paginate();
        return view ('productos.index', ['productos'=>$productos]);
    }

    public function create()
    {
      
        $producto = new Producto();

        $categorias = Categoria::all();
        $marcas     = Marca::all();
        $proveedores = Proveedore::all();
        $sub_categorias = Sub_categoria::all();
        $unidad_productos = Unidad_producto::all();
        
        return view('productos.create', ['producto'=>$producto, 'categorias'=>$categorias, 'marcas'=>$marcas, 'proveedores'=>$proveedores, 'unidad_productos'=>$unidad_productos, 'sub_categorias'=>$sub_categorias]);
    }

    public function store(Request $request)
    {
        //instanciar los modelos de las tablas productos
        $productos = new Producto();

        //sacando datos del formulario
        $productos->barCodigo = $request->get('barCodigo');
        $productos->categoria_id = $request->get('categoria_id');
        $productos->sub_categoria_id = $request->get('sub_categoria_id');
        $productos->marca_id = $request->get('marca_id');
        $productos->nombre_producto = $request->get('nombre_producto');
        $productos->slug = Str::slug($request->get('nombre_producto'));
        $productos->unidad_producto_id = $request->get('unidad_producto_id');
        $productos->descripcion = $request->get('descripcion'); 
         
        //subir la imagen al proyecto
        if($imagen = $request->hasFile('imagen')){
            $imagen = $request->file('imagen');
            
            $rutaGuardarImg = 'imagen/';
            $imagenProducto = date('YmdHis')."_".$imagen->getClientOriginalName();
            $imagen->move($rutaGuardarImg, $imagenProducto);
            $productos->imagen=$rutaGuardarImg."".$imagenProducto;
        }
        //guardar en la tabla productos
        $productos->save();       

        return redirect('productos');
    }

    public function show($id)
    {   
        //buscamos el producto
        $producto = Producto::with('categoria','marca','unidad_producto')->find($id);

        $detalle_productos = Detalle_compra::JOIN('productos','detalle_compras.producto_id','=','productos.id')
                                           ->JOIN('compra_productos','detalle_compras.compra_producto_id', '=', 'compra_productos.id')    
                                           ->where('detalle_compras.producto_id',$id)
                                           ->orderBy('detalle_compras.id', 'desc')
                                           ->get(['detalle_compras.*','productos.nombre_producto', 'compra_productos.*']);   
        
        $detalle_ventas = Detalle_venta::JOIN('productos','detalle_ventas.producto_id','=','productos.id')
                                           ->JOIN('ventas','detalle_ventas.venta_id', '=', 'ventas.id')    
                                           ->where('detalle_ventas.producto_id',$id)
                                           ->orderBy('detalle_ventas.id', 'desc')
                                           ->get(['detalle_ventas.*','productos.nombre_producto', 'ventas.*']);   
                                           
        //buscamos los variantes del producto
        $variante_producto = Variante_producto::where('producto_id',$id)->get();
        
       return view('productos.show', ['producto'=>$producto, 'detalle_productos'=>$detalle_productos, 'variante_producto'=>$variante_producto,'detalle_ventas'=>$detalle_ventas]);
    }
 
    public function edit($id)  {         

       $producto = Producto::find($id);
       $producto_id = $id; 
          
        $categorias = Categoria::all();
        $marcas     = Marca::all();
        $proveedores = Proveedore::all();
        $sub_categorias = Sub_categoria::all();
        $unidad_productos = Unidad_producto::all();       
        
        return view('productos/edit', ['producto'=>$producto, 
                    'categorias'=>$categorias, 'marcas'=>$marcas, 'proveedores'=>$proveedores, 'unidad_productos'=>$unidad_productos, 'sub_categorias'=>$sub_categorias]);
    }

    public function update(Request $request, $id)
    {
        $productos = Producto::find($id);
        
        $productos->barCodigo = $request->get('barCodigo');
        $productos->categoria_id = $request->get('categoria_id');
        $productos->sub_categoria_id = $request->get('sub_categoria_id');
        $productos->marca_id = $request->get('marca_id');
        $productos->nombre_producto = $request->get('nombre_producto');
        $productos->slug = Str::slug($request->get('nombre_producto'));
        $productos->unidad_producto_id = $request->get('unidad_producto_id');
        $productos->descripcion = $request->get('descripcion'); 
        
        if($imagen = $request->hasFile('imagen')){
            $imagen = $request->file('imagen');
            $rutaGuardarImg = 'imagen/';
            $imagenProducto = date('YmdHis')."_".$imagen->getClientOriginalName();
            $imagen->move($rutaGuardarImg, $imagenProducto);
            $productos->imagen=$rutaGuardarImg."".$imagenProducto;
        }
        else{
            unset($productos['imagen']);
        }

        $productos->save();       

        return redirect('productos');
    }

    public function registrar(Request $request){

        $producto = new Producto();
        //$slug = $request->nombre_producto;
        $producto->barCodigo = $request->barCodigo;        
        $producto->categoria_id = $request->categoria_id;
        $producto->sub_categoria_id = $request->sub_categoria_id;
        $producto->marca_id = $request->marca_id;
        $producto->nombre_producto = $request->nombre_producto;
        $producto->unidad_producto_id = $request->unidad_producto_id;
        $slug = Str::slug($request->nombre_producto);
        $producto->slug = $slug;
        
        $producto->descripcion = $request->descripcion;
       // $var = $request->descripcion;
        $producto->save();
        
        $ultimo_producto = Producto::latest()->first();

        $productos = Producto::where('estado','A')->get();

        return response()->json(['productos'=>$productos, 'ultimo_producto'=>$ultimo_producto]);
    }

    public function destroy($id)
    {
        //Controlando si tiene dependencias
        $detalle_compra= Detalle_compra::where('producto_id',$id)->first();
        if($detalle_compra === null){
            $producto = Producto::find($id);  
            $producto->delete();
            return redirect('productos')->with('message','Producto eliminado Correctamente')->with('color','success');
        }
        else{
            return redirect('productos')->with('message','El producto tiene dependencias no se puede borrar')->with('color','danger');    
        }
    }
}
