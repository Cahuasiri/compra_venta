<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datos_empresa;

class Datos_empresaController extends Controller
{

    public function index()
    {   
        $datos_empresa = Datos_empresa::find(1);

        return view('datos_empresa._create',['datos_empresa'=>$datos_empresa]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $datos_empresa = Datos_empresa::find(1);

        //sacando datos del formulario
        $datos_empresa->nombre_empresa = $request->get('nombre_empresa');
        $datos_empresa->nit = $request->get('nit');
        $datos_empresa->correo = $request->get('correo');
        $datos_empresa->telefono = $request->get('telefono');
        $datos_empresa->direccion = $request->get('direccion');
        $datos_empresa->compra_referencia = $request->get('compra_referencia');
        $datos_empresa->venta_referencia = $request->get('venta_referencia');
        $datos_empresa->coti_referencia = $request->get('coti_referencia');
        $datos_empresa->moneda = $request->get('moneda');
        $datos_empresa->descripcion = $request->get('descripcion');
      
        //subir logo al sistema
        if($logo = $request->hasFile('imagen_')){
            $logo = $request->file('imagen_');
            
            $rutaGuardarLogo = 'imagen/';
            $logoEmpresa = $logo->getClientOriginalName();
            $logo->move($rutaGuardarLogo, $logoEmpresa);
            $datos_empresa->logo=$rutaGuardarLogo."".$logoEmpresa;
        }
        //guardar en la tabla productos
        $datos_empresa->save();       

        $datos_empresa1 = Datos_empresa::find(1);

        return view('datos_empresa._create',['datos_empresa'=>$datos_empresa1]);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
