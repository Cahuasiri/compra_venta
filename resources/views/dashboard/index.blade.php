@extends('adminlte::page')

@section('title', 'Admin')

@section('content_header')
    <h1>Resumen</h1>
@stop

@section('content')

<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{$total_productos}}</h3>
                <p>Productos</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="{{route('productos.index')}}" class="small-box-footer">Mas info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{$total_compras}}<sup style="font-size: 20px">%</sup></h3>
                <p>Compras</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{route('compra_productos.index')}}" class="small-box-footer">Mas info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{$total_ventas}}</h3>
                <p>Ventas</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="{{route('ventas.index')}}" class="small-box-footer">Mas info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{$total_cotizaciones}}</h3>
                <p>Corizaciones</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{route('cotizaciones.index')}}" class="small-box-footer">Mas info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Productos en Almacen</h3>
                    </div>
 
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Items</th>
                                    <th>Progress</th>
                                    <th style="width: 40px">Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $cont=1; ?>
                                @foreach ($productos as $producto)
                                    <tr>
                                        <td>{{$cont}}</td>
                                        <td>{{ $producto->nombre_producto }}</td> 
                                        <td>
                                            <div class="progress progress-xs">
                                                <?php $porcentaje = $producto->stock*400/100; ?>
                                                <div class="progress-bar bg-primary" style="width: {{$porcentaje}}%"></div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($producto->stock > 7)
                                                <span class="badge bg-success" style="font-size: medium">{{ $producto->stock }}</span>
                                            @endif
                                            @if(($producto->stock < 7)  && ($producto->stock > 3))
                                                <span class="badge bg-warning" style="font-size: medium">{{ $producto->stock }}</span>
                                            @endif
                                            @if($producto->stock < 3)
                                                <span class="badge bg-danger" style="font-size: medium">{{ $producto->stock }}</span>
                                            @endif
                                            
                                        </td>            
                                    </tr>
                                    <?php $cont++; ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                            <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                 <div class="card-header">
                    <h3 class="card-title">Ventas de Productos</h3>
                    <div class="card-tools">
                        <ul class="pagination pagination-sm float-right">
                            <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                        </ul>
                    </div>
                </div>

                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Fecha</th>
                                <th>Referencia</th>
                                <th style="width: 40px">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ventas as $venta)
                                <tr>
                                    <td></td>
                                    <td>{{ $venta->fecha_venta }}</td> 
                                    <td>
                                        {{$venta->nro_referencia}}             
                                    </td>
                                    <td><span class="badge bg-success" style="font-size: medium">{{ $venta->total }}</span></td>            
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
