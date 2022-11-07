@extends('adminlte::page')

@section('title', 'Admin')

@section('content')
<form action="{{route('verproductos.create')}}" method="POST">
    @csrf
    @method('GET')   
    <select name="producto_id" id="producto_id" class="form-control" onchange="this.form.submit()">
        <option value="">Seleccione producto</option>
        @foreach($_productos as $_producto)
            <option value="{{$_producto->id}}"> {{$_producto->barCodigo}} - {{$_producto->producto}}</option>
        @endforeach
    </select>  
</form>
<div class="card card-outline card-success">
<div class="m-4">
    <ul class="nav nav-pills" id="myTab">
        <li class="nav-item">
            <a href="#home" class="nav-link active">Detalle Producto</a>
        </li>
        <li class="nav-item">
            <a href="#profile" class="nav-link">Detalle Ingreso</a>
        </li>
        <li class="nav-item">
            <a href="#messages" class="nav-link">Detalle Salida</a>
        </li>
    </ul>
 
    <div class="tab-content">
        <div class="tab-pane fade show active" id="home">
            <div class="box">
                <div class="box-header">
                    <h4 style="color:blue;">
                        <i class="fa fa-solid fa-barcode"></i>
                        {{ $producto->producto }}   
                    </h4>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="introtext">Detalles de Producto</p>
                            <div class="row">
                                <div class="col-sm-5">
                                    <img src="/{{ $producto->imagen }}" alt="" class="img-responsive img-thumbnail">
                                </div>
                                <div class="col-sm-7">
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-striped dfTable table-right-left">
                                            <tbody>
                                               
                                                <tr>
                                                    <td style="width:30%;">Codigo</td>
                                                    <td style="width:70%">
                                                        <div class="mb-3">
                                                            {!! DNS1D::getBarcodeHTML($producto->barCodigo, 'PHARMA') !!}
                                                            <!-- {!! DNS2D::getBarcodeHTML($producto->barCodigo, 'QRCODE') !!} -->
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td >Nombre</td>
                                                    <td><strong>{{ $producto->producto }}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Codigo</td>
                                                    <td><strong>{{ $producto->barCodigo }}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Marca</td>
                                                    <td><strong>{{ $producto->marca->nombre }}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Categoria</td>
                                                    <td><strong>{{ $producto->categoria->categoria }}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Unidad</td>
                                                    <td><strong>{{ $producto->medida }}</strong></td>
                                                </tr>                                                
                                                <tr>
                                                    <td>Stock</td>
                                                    <td> <h4> <span class="badge badge-pill badge-warning">{{$producto->stock }}</span>  </h4> </td>
                                                </tr>                                          
                                            </tbody>
                                        </table>
                                        <label for="form-control">Variantes:</label>
                                        @foreach($variante_producto as $vproducto)
                                            <span class="badge badge-info">{{$vproducto->var_nombre}}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                          
                            <div class="row">
                                <div class="d-flex justify-content-center mb-2 col-lg-12" style="background:#F5FBFA" >
                                    <button class="btn btn-primary btn-ms" type="button">Imprimir PDF</button> &nbsp;&nbsp;
                                    <button class="btn btn-secondary btn-ms" type="button">Export Excel</button>&nbsp;&nbsp;
                                    <button class="btn btn-info btn-ms" type="button">Imprimir</button>&nbsp;&nbsp;
                                    <a href="{{route('verproductos.index')}}" class="btn btn-danger btn-ms">Volver</a>                                    
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="profile">
        <div class="box">
                <div class="box-header">
                    <h4 style="color:blue;"> &nbsp;&nbsp;
                        <i class="fa fa-solid fa-barcode"></i>
                        {{ $producto->producto }}   
                    </h4>
                </div>
                <div class="box-content">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Fecha</th><th>Costo/Compra</th><th>Costo/Venta</th><th>Cantidad</th><th>Proveedor</th><th>Detalle</th><th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($detalleProducto as $dproducto)
                                <tr>
                                    <td>{{$dproducto->fechaIngreso}}</td>
                                    <td>{{$dproducto->costoCompra}}</td>
                                    <td>{{$dproducto->costoVenta}}</td>
                                    <td>{{$dproducto->cantidad}}</td>
                                    <td>{{$dproducto->nombre}} </td>
                                    <td>{{$dproducto->detalle}} </td>
                                    <td><a href="#" title="Comprobante"><i class="fas fa-file-alt"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        </div>        
        </div>
        <div class="tab-pane fade" id="messages">
            <h4 class="mt-2">ventas</h4>
            <p>En Construccion!! Todavia</p>
        </div>
    </div>
</div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    $(document).ready(function(){
        $("#myTab a").click(function(e){
            e.preventDefault();
            $(this).tab("show");
        });
    });
</script>
@stop