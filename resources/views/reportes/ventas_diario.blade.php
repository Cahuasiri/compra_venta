@extends('adminlte::page')

@section('title', 'Admin')

@section('content')
 
<div class="card animate__animated animate__fadeIn">        
    <div class="card-header">
        <a href="{{route('reporte_ventas.index')}}"> << Volver </a> &nbsp;
            Fecha
            <strong>{{ $dt }}</strong>
            <span class="float-right"> <a href="javascript:window.print()"> Imprimir </a> &nbsp; <strong>Ref.:</strong> </span>
    </div>
    <div class="card-body">
        <p class="text-center"> <h2 class="text-center"> Reporte de Ventas</h2></p>
        <div class="table-responsive-sm">
            <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th scope="col" width="2%" class="center">#</th>
                    <th scope="col" width="20%">Factura</th>
                    <th scope="col" class="d-none d-sm-table-cell" width="20%">Cliente</th>
                    <th scope="col" class="d-none d-sm-table-cell" width="20%">subtotal</th>
                    <th scope="col" class="d-none d-sm-table-cell" width="20%">impuesto</th>
                    <th scope="col" class="d-none d-sm-table-cell" width="20%">descuento</th>
                    

                    <th scope="col" width="10%" class="text-right">Total</th>
                    <th scope="col" width="20%" class="text-right">Referencia</th>
                </tr>
                        </thead>
                        <tbody>
                            <?php $contador = 1; $suma_sub_total = 0; $impuesto=0; $descuento = 0; $total = 0;?>
                            @foreach($ventas as $venta)                                                                                        
                                <tr>
                                    <td class="text-left">{{ $contador }}</td>
                                    <td class="item_name">{{ $venta->nro_factura }}</td>
                                    <td class="item_desc d-none d-sm-table-cell">{{ $venta->cliente }}</td>

                                    <td class="text-left">{{ $venta->sub_total}}</td>
                                    <td class="text-left">{{ $venta->impuesto }}</td>
                                    <td class="text-left">{{ $venta->descuento }}</td>
                                    <td class="text-left">{{ $venta->total }}</td>
                                    <td class="text-right">{{ $venta->nro_referencia }}</td>
                                </tr>
                                <?php $contador++;
                                    $suma_sub_total=$suma_sub_total + $venta->sub_total;
                                    $impuesto = $impuesto + $venta->impuesto;
                                    $descuento = $descuento + $venta->descuento;
                                    $total = $total + $venta->total; ?>
                            @endforeach   
                        </tbody>
                        <tfoot>
                            <th colspan="3" class="text-right">TOTALES</th>
                            <th>{{ $suma_sub_total }}</th>
                            <th>{{ $impuesto }}</th>
                            <th>{{ $descuento }}</th>
                            <th>{{ $total }}</th>
                            <th></th>
                        </tfoot>
                    </table>
                </div>
        </div>

        <div class="d-flex justify-content-center">
                    <br><br><br><br><br><br>
                    <table>
                            <tr>
                                <td  class="text-center">
                                    <div class="text-center">-------------------------------------------</div>
                                    Autor:{{ auth()->user()->name }} 
                                </td>
                            </tr>
                    </table>
        </div>
    </div>  
</div>        
             
@stop

@section('js')

@stop