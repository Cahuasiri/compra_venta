<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personas = Persona::paginate(10);
        return view('personas.index',compact('personas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Persona $persona)
    {
        return view('personas.create',['persona'=>$persona]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $personas = new Persona();

        $personas->nombre = $request->get('nombre');
        $personas->cedula = $request->get('cedula');
        $personas->sexo = $request->get('sexo');
        $personas->email = $request->get('email');
        $personas->direccion = $request->get('direccion');
        $personas->foto = $request->get('foto');
       // $personas->estado = $request->get('nombre');
        //dump($personas);
        $personas->save();

       return redirect('personas');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $persona = Persona::find($id);

        return view('personas.edit')->with('persona',$persona);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $personas = Persona::find($id);

        $personas->nombre = $request->get('nombre');
        $personas->cedula = $request->get('cedula');
        $personas->sexo = $request->get('sexo');
        $personas->email = $request->get('email');
        $personas->direccion = $request->get('direccion');
        $personas->foto = $request->get('foto');
       // $personas->estado = $request->get('nombre');

        $personas->save();

        return redirect('personas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $persona = Persona::find($id);

        $persona->delete();

        return redirect('personas');
    }
}
