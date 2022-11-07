<?php

namespace App\Http\Controllers;
use PDF;

use Illuminate\Http\Request;

class PDFController extends Controller
{
    //
    public function preview()
    {
        return view('compra_productos.recibo');
    }

    public function generatePDF()
    {
        $pdf = PDF::loadView('compra_productos.recibo');    
        return $pdf->download('demo.pdf');
    }
}
