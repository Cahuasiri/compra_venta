<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Categoria;
use App\Models\Sub_categoria;
use App\Models\Producto;


class Sub_categoriaController extends Controller
{
    public function index($id)
    {   
        $categorias = Categoria::all();
        $sub_categorias = Sub_categoria::with('categoria')->where('categoria_id', $id)->get();
    
        return view('sub_categorias.index', ['sub_categorias'=>$sub_categorias, 'categorias'=>$categorias]);
    }

    public function mostrar_subcategorias($id)
    {   
        $categoria = Categoria::where('id', $id)->get();
        $sub_categorias = Sub_categoria::with('categoria')->where('categoria_id', $id)->get();
    
        return view('sub_categorias.index', ['sub_categorias'=>$sub_categorias, 'categoria'=>$categoria[0]['nombre'], 'categoria_id'=>$categoria[0]['id']]);
    }

    public function create(Sub_categoria $sub_categoria)
    {
        $categorias = Categoria::all();
        return view('sub_categorias.create',['sub_categoria'=>$sub_categoria, 'categorias'=>$categorias]);
    }

    public function store(Request $request)
    {
        $sub_categoria = new Sub_categoria();

        $request->validate([
                'categoria_id' => 'required',
                'nombre'     =>  'required',
                'descripcion'   =>  'required'
        ]);

        $sub_categoria->categoria_id = $request->get('categoria_id');
        $sub_categoria->nombre = $request->get('nombre');
        $sub_categoria->descripcion = $request->get('descripcion');

        $sub_categoria->save();

        $categoria_id = $request->get('categoria_id');
        $categoria = Categoria::where('id', $categoria_id)->get();
        $sub_categorias = Sub_categoria::with('categoria')->where('categoria_id', $categoria_id)->get();

        return view('sub_categorias.index', ['sub_categorias'=>$sub_categorias, 'categoria'=>$categoria[0]['nombre'], 'categoria_id'=>$categoria[0]['id']]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {   
        $categorias = Categoria::all();
        $sub_categoria = Sub_categoria::find($id);
        return view('sub_categorias.edit',['categorias'=>$categorias])->with('sub_categoria', $sub_categoria);
    }

    public function update(Request $request, $id)
    {
        $sub_categoria = Sub_categoria::find($id);
        $request->validate([
            'categoria_id' => 'required',
            'nombre'     =>  'required',
            'descripcion'   =>  'required'
       ]);

        $sub_categoria->categoria_id = $request->get('categoria_id');
        $sub_categoria->nombre = $request->get('nombre');
        $sub_categoria->descripcion = $request->get('descripcion');

        $sub_categoria->save();

        return redirect('sub_categorias')->with('message','Modificado correctamente');
    }

    public function destroy($id)
    {
            //Controlando si tiene dependencias
            $producto = Producto::where('sub_categoria_id',$id)->first();
            if($producto == null){
                $sub_categoria = Sub_categoria::find($id);  
                $sub_categoria->delete();
                return redirect('sub_categorias')->with('message','Eliminado Correctamente')->with('color','success');
            }
            else{
                return redirect('sub_categorias')->with('message','La Sub Categoria tiene dependencias no se puede borrar')->with('color','danger');    
            }
    }
}
