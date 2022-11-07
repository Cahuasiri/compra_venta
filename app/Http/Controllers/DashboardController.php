<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Compra_producto;
use App\Models\Venta;
use App\Models\Cotizacione;


class DashboardController extends Controller
{
    //
    public function index(){

        $productos = Producto::all();
        $total_productos = count($productos);

        $compras = Compra_producto::all();
        $total_compras = count($compras);

        $ventas = Venta::all();
        $total_ventas = count($ventas);

        $cotizaciones = Cotizacione::all();
        $total_cotizaciones = count($cotizaciones);
        return view('dashboard/index', ['total_productos'=>$total_productos, 'total_compras'=>$total_compras, 
                                        'total_ventas'=>$total_ventas,'total_cotizaciones'=>$total_cotizaciones,
                                        'productos'=>$productos, 'ventas'=>$ventas]);
    }
}
