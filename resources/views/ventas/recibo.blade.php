@extends('adminlte::page')

@section('title', 'Admin')

@section('css')
 <!-- <link rel="stylesheet" href="/css/recibo.css"> -->
@stop

@section('content')   

        <div class="card animate__animated animate__fadeIn">        
            <div class="card-header">
            <a href="{{route('ventas.index')}}"> << Volver </a> &nbsp;
                Fecha
                <strong>{{ $ultimaVenta->fecha_venta }}</strong>
                <span class="float-right"> <a href="javascript:window.print()"> Imprimir </a> &nbsp; <strong>Ref.:</strong> {{$ultimaVenta->nro_referencia}}</span>
            </div>
            <div class="card-body">
            <p class="text-center"> <h2 class="text-center"> NOTA DE VENTA</h2></p>
                <div class="row mb-4">
                    <div class="col-6 col-md-6">
                        <h6 class="mb-2">DE:</h6>
                        <div>
                            <strong>CHURAS(Distribuidora)</strong>
                        </div>
                        <div>Casa Matriz</div>
                        <div>Calle las Americas # 3456 Tarija-Bolivia</div>
                        <div> <strong>Email: </strong> churasdistribuidora@gmail.com</div>
                        <div> <strong>Phone:</strong>  +594-72976858</div>
                    </div>

                    <div class="col-6 col-md-6">
                        <h6 class="mb-2">PARA:</h6>
                        <div>
                            <strong>{{ $cliente->nombre_cliente }}</strong>
                        </div>
                        <div>{{ $cliente->nombre_empresa }}</div>
                        <div>{{ $cliente->nit_ci }}</div>
                        <div>Email: {{ $cliente->email }}</div>
                        <div>Phone: {{ $cliente->telefono }}</div>
                    </div>

                </div>

                <div class="table-responsive-sm">
                    <table class="table table-sm table-striped">
                        <thead>
                            <tr>
                                <th scope="col" width="2%" class="center">#</th>
                                <th scope="col" width="20%">Producto/Servicio</th>
                                <th scope="col" class="d-none d-sm-table-cell" width="50%">Descripción</th>

                                <th scope="col" width="10%" class="text-right">P. Unidad</th>
                                <th scope="col" width="8%" class="text-right">Cantidad.</th>
                                <th scope="col" width="10%" class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $contador = 1; ?>
                            @foreach($detalle_ventas as $dventa)                                                                                        
                                <tr>
                                    <td class="text-left">{{ $contador }}</td>
                                    <td class="item_name">{{ $dventa->barCodigo }}</td>
                                    <td class="item_desc d-none d-sm-table-cell">{{ $dventa->nombre_producto }}</td>

                                    <td class="text-right">{{ $dventa->precio_unitario }}</td>
                                    <td class="text-right">{{ $dventa->cantidad }}</td>
                                <td class="text-right"><?php $stotal = $dventa->precio_unitario*$dventa->cantidad; echo $stotal; ?></td>
                                </tr>
                                <?php $contador++; ?>
                            @endforeach   
                           
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-5"> 
                    </div>

                    <div class="col-lg-4 col-sm-5 ml-auto">
                        <table class="table table-sm table-clear">
                            <tbody>
                                <tr>
                                    <td class="left">
                                        <strong>Subtotal</strong>
                                    </td>
                                    <td class="text-right bg-light">{{ $ultimaVenta->sub_total }}€</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>Descuento ({{$ultimaVenta->descuento_porcentaje}}%)</strong>
                                    </td>
                                    <td class="text-right bg-light">{{$ultimaVenta->descuento}}€</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>IVA (13%)</strong>
                                    </td>
                                    <td class="text-right bg-light">{{$ultimaVenta->impuesto }}€</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>Total</strong>
                                    </td>
                                    <td class="text-right bg-light">
                                        <strong>{{$ultimaVenta->total }}€</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                </div>
                <div class="d-flex justify-content-center">
                    <br><br>
                    <table>
                            <tr>
                                <td  class="text-center">-------------------------------------------</td>
                            </tr>
                            <tr>
                                <td  class="text-center">Vendido por:{{ auth()->user()->name }} </td>
                            </tr>
                    </table>
                </div>
            </div>
        </div>

<div class="footer container-fluid mt-3 bg-light">
    <div class="row">
        <div class="col footer-app">&copy; Todos los derechos reservados · <span class="brand-name"></span></div>
    </div>
</div>      
@stop

@section('js')

@stop