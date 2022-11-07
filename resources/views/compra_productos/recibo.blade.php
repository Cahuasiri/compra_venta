@extends('adminlte::page')

@section('title', 'Admin')

@section('css')
 <!-- <link rel="stylesheet" href="/css/recibo.css"> -->
@stop

@section('content')   

        <div class="card animate__animated animate__fadeIn">        
            <div class="card-header">
                <a href="{{route('compra_productos.index')}}"> << Volver </a> &nbsp;
                Fecha:
                <strong>{{ $ultimaCompra->fecha }}</strong>
                <!-- <span class="float-right"> <a href="{{ route('generar_pdf.generarPDF', $ultimaCompra->id) }}"> Imprimir </a> &nbsp; <strong>Ref.:</strong> {{$ultimaCompra->referencia}}</span> -->
                <span class="float-right"> <a href="javascript:window.print()"> Imprimir </a> &nbsp; <strong>Ref.:</strong> {{$ultimaCompra->referencia}}</span>
            </div>
            <div class="card-body">
            <p class="text-center"> <h2 class="text-center"> NOTA DE COMPRA</h2></p>
                <div class="row mb-4">
                    <div class="col-6 col-md-6">
                        <h6 class="mb-2">DE:</h6>
                        <div>
                            <strong>{{ $proveedore->nombre }}</strong>
                        </div>
                        <div>{{ $proveedore->direccion }}</div>
                        <div>{{ $proveedore->nit }}</div>
                        <div>Email: {{ $proveedore->email }}</div>
                        <div>Phone: {{ $proveedore->telefono }}</div>
                    </div>
                    <div class="col-6 col-md-6">
                        <h6 class="mb-2">PARA:</h6>
                        <div>
                            <strong>CHURAS(Distribuidora)</strong>
                        </div>
                        <div>Casa Matriz</div>
                        <div>Calle las Americas # 3456 Tarija-Bolivia</div>
                        <div> <strong>Email: </strong> churasdistribuidora@gmail.com</div>
                        <div> <strong>Phone:</strong>  +594-72976858</div>
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
                                <th scope="col" width="10%" class="text-right">P. p/Venta</th>
                                <th scope="col" width="8%" class="text-right">Cantidad.</th>
                                <th scope="col" width="10%" class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $contador = 1; ?>
                            @foreach($detalle_compras as $dcompra)                                                                                        
                                <tr>
                                    <td class="text-left">{{ $contador }}</td>
                                    <td class="item_name">{{ $dcompra->barCodigo }}</td>
                                    <td class="item_desc d-none d-sm-table-cell">{{ $dcompra->nombre_producto }}</td>

                                    <td class="text-right">{{ $dcompra->costoCompra }}</td>
                                    <td class="text-right">{{ $dcompra->costoVenta }}</td>
                                    <td class="text-right">{{ $dcompra->cantidad }}</td>
                                <td class="text-right"><?php $stotal = $dcompra->costoCompra*$dcompra->cantidad; echo $stotal; ?></td>
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
                                    <td class="text-right bg-light">{{ $ultimaCompra->costo_total }}€</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>Descuento (%)</strong>
                                    </td>
                                    <td class="text-right bg-light">€</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>IVA (13%)</strong>
                                    </td>
                                    <td class="text-right bg-light">€</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>Total</strong>
                                    </td>
                                    <td class="text-right bg-light">
                                        <strong>{{$ultimaCompra->costo_total }}€</strong>
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
                                <td  class="text-center">Reg. por:{{ auth()->user()->name }} </td>
                            </tr>
                    </table>
                </div>
            </div>
        </div>

<div class="footer container-fluid mt-3 bg-light">
    <div class="row">
        <!-- <div class="col footer-app">&copy; Todos los derechos reservados · <span class="brand-name"></span></div> -->
    </div>
</div>      
@stop

@section('js')

@stop