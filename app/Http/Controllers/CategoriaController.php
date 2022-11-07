<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Categoria;
use Illuminate\Support\Str;
use App\Models\Producto;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        return view('categorias.index', compact('categorias'));
    }
   
    public function create(Categoria $categoria)
    {
        return view('categorias.create',['categoria'=>$categoria]);
    }

    public function store(Request $request)
    {
       $categorias = new Categoria();

       $request->validate([
            'nombre'     =>  'required',
            'descripcion'   =>  'required'
       ]);

       $categorias->nombre = $request->get('nombre');
       $categorias->descripcion = $request->get('descripcion');

       $categorias->save();

       return redirect('categorias')->with('message','Creado correctamente');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $categoria = Categoria::find($id);
        return view('categorias.edit')->with('categoria', $categoria);
    }

    public function update(Request $request, $id)
    {
        $categoria = Categoria::find($id);
        $request->validate([
            'nombre'     =>  'required',
            'descripcion'   =>  'required'
       ]);

        $categoria->nombre = $request->get('nombre');
        $categoria->descripcion = $request->get('descripcion');

        $categoria->save();

        return redirect('categorias')->with('message','Modificado correctamente');
    }

    public function destroy($id)
    {       
            //Controlando si tiene dependencias
            $producto = Producto::where('categoria_id',$id)->first();
            if($producto === null){
                $categoria = Categoria::find($id);  
                $categoria->delete();
                return redirect('categorias')->with('message','Eliminado Correctamente');
            }
            else{
                return redirect('categorias')->with('message','La Categoria tiene dependencias no se puede borrar');    
            }
    }
}
