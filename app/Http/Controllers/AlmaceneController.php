<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Almacene;

class AlmaceneController extends Controller
{
   
    public function index()
    {
        $almacenes = Almacene::all();
        return view('almacenes.index', compact('almacenes'));
    }

    public function create(Almacene $almacene)
    {
        return view('almacenes.create', ['almacene'=>$almacene]);
    }

    public function store(Request $request)
    {
       $almacenes = new Almacene();

       $request->validate([
                'nombre'   =>  'required',
                'ubicacion' =>  'required'
       ]);

       $almacenes->nombre = $request->get('nombre');
       $almacenes->ubicacion = $request->get('ubicacion');

       $almacenes->save();

       return redirect('almacenes');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $almacene = Almacene::find($id);
        return view ('almacenes.edit')->with('almacene', $almacene);
    }

    public function update(Request $request, $id)
    {
        $almacene = Almacene::find($id);
        
        $request->validate([
            'nombre'   =>  'required',
            'ubicacion' =>  'required'
         ]);
        $almacene->nombre = $request->get('nombre');
        $almacene->ubicacion = $request->get('ubicacion');

        $almacene->save();

        return redirect('almacenes');
    }

    public function destroy($id)
    {   
        $almacen = Almacene::find($id);
        $compra_producto = DB::table('compra_productos')->where('almacen_id',$id)->get();
        $registros= count($compra_producto);
        if($registros >= '1'){
            return redirect('almacenes')->with('eliminar', 'no');
        }
        else{
            $almacen->delete();
            return redirect('almacenes')->with('eliminar', 'ok');
        }

        $almacene = Almacene::find($id);
        $almacene->delete();

        return redirect('almacenes');
    }
}
