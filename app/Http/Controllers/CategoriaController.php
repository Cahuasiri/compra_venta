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
            'nombre'     =>  'required|unique:categorias',
            'descripcion'   =>  'required'
       ],
       [
            'nombre.required'       => 'El nombre es Requerido',
            'descripcion.required'  =>  'La descripcion es Requerido',
            'nombre.unique' => 'La categoria ya Existe'
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
        $categoria = Categoria::find($id);
        $productos = DB::table('productos')->where('categoria_id',$id)->get();
        $registros= count($productos);
        if($registros >= '1'){
            return redirect('categorias')->with('eliminar', 'no');
        }
        else{
            $categoria->delete();
            return redirect('categorias')->with('eliminar', 'ok');
        }    
    }
}
