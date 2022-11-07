@extends('adminlte::page')

@section('title', 'Admin')

@section('content')
<form action="{{route('compra_productos.store')}}" method="POST" id="basic-form">
@csrf
<div class="card card-outline card-primary mt-2">
    <div class="card-header">
        <span>Ingrese sus datos en el formulario</span>
    </div>
    <div class="card-body">
        
        <div class="row">
            <div class="col-sm-4">
                <label for="">Fecha <span>*</span></label>
                <input type="datetime-local" class="form-control" name="fecha_compra" id="fecha_compra" value="{{$dt}}" required>
            </div>
            <div class="col-sm-4">
                <label for="">Referencia/Nro. Orden <span>*</span></label>
                <input type="text" class="form-control" name="referencia" value="" required>
            </div>
            <div class="col-sm-4">
                <label for="">Almacen <span>*</span></label>                
                <select name="almacen_id" id="" class="form-control" required>
                    @foreach($almacenes as $almacene)
                        <option value="{{$almacene->id}}">{{$almacene->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="input-group mb-3">
                    <div class="input-group-text">
                        Proveedores
                    </div>    
                    <select class="form-select" id="proveedor" data-placeholder="Seleccione Proveedor" name="proveedor_id" required>
                        <option value=""></option>
                        @foreach($proveedores as $proveedore)
                            <option value="{{$proveedore->id}}">{{$proveedore->nombre}}</option>                                      
                        @endforeach
                    </select>
                    <div class="input-group-text">
                        <a href="#" class="btn btn-primary btn-sm"><i class='fas fa-user blue-color'></i></a> &nbsp;
                        <a href="{{ route('proveedores.create') }}" class="btn btn-primary btn-sm"><i class='fas fa-plus-square blue-color'></i></a>
                    </div>
                </div>                   
            </div>
        </div>
        <div class="row">             
            <div class="col-sm-12">
            <div class="card card-info mb-2">
                    <div class="card-header">
                       Agregar los productos que van a ingresar al Sistema
                    </div>
                    <div class="card-body">              
                        <div class="row">
                            <div class="col-sm-12">
                            <div class="input-group mb-3">                                        
                                <select name="producto_id" id="producto_id" class="form-select" data-placeholder="Seleccione un Producto">
                                    <option value=""></option>
                                    @foreach($productos as $producto)
                                        <option value="{{$producto->id}}"> {{$producto->barCodigo}} - {{$producto->nombre_producto}}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-text">
                                    <a href="#" class="btn btn-primary btn-sm"><i class='fas fa-tags blue-color'></i></a> &nbsp;
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevo_producto">
                                        <i class='fas fa-plus-square blue-color'></i>
                                    </button>
                                    <!-- <a href="{{ route('productos.create') }}" class="btn btn-primary btn-sm"></a> -->
                                </div>
                            </div>
                            <div class="card w-100 card-outline card-info" >
                                <div class="card-body"> 
                                <table class="display responsive nowra" width="100%" style="border: 1px;" id="myTable">
                                    <thead style="background-color:#f8f9fa">
                                        <tr>
                                        <th>Producto (código - Nombre)</th>
                                        <th>Cantidad</th> 
                                        <th>Precio - Compra)</th>
                                        <th>Precio - Venta</th>
                                        <th>SubTotal</th>                        
                                        <th></th>
                                        </tr>                            
                                    </thead>
                                    <tbody id="capaproductos">                                       
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4" style="text-align: right">Totales</th>
                                            <th style="text-align: center"><span class="total"> </span></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>                        
                                </table>
                                </div>
                            </div>
                            </div>
                        </div>                            
                    </div>
                </div>                
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="input-group mb-3">
                    <div class="input-group-text">
                        Tipo pago
                    </div>    
                    <select class="form-control" id="tipo_pago_id" data-placeholder="Seleccione Proveedor" name="tipo_pago_id" required>
                        @foreach($tipo_pagos as $tipo_pago)
                            <option value="{{$tipo_pago->id}}">{{$tipo_pago->nombre}}</option>                                      
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-3" id="cuotas">
                <div class="input-group mb-3">
                    <div class="input-group-text">
                       Nro. Cuotas
                    </div>    
                    <input type="number" class="form-control" name="cuotas" id="cuotas" value="0" step="1" value="0" required>
                </div>
            </div>
            <div class="col-sm-3" id="fecha_limite">
                <div class="input-group mb-3">
                    <div class="input-group-text">
                       Fec. Limite
                    </div>    
                    <input type="datetime-local" class="form-control" name="fecha_limite" id="fecha_limite" value="{{$dt}}" required>
                </div>
            </div>
            <div class="col-sm-6" id="nro_cuenta">
                <div class="input-group mb-3">
                    <div class="input-group-text">
                       Banco y numero de cuenta
                    </div>    
                    <input type="text" class="form-control" name="nro_cuenta" id="nro_cuenta" value="" required>
                </div>
            </div>
            <div class="col-sm-3" id="descuento">
                <div class="input-group mb-3">
                    <div class="input-group-text">
                       Desc. en %
                    </div>    
                    <input type="number" class="form-control" name="descuento" id="descuento" value="0" step="1" required>
                </div>
            </div>
        </div>      
    </div>
    <div class="d-flex justify-content-center mb-2 card-footer">
            <input type="submit" value="Guardar" class="btn btn-primary"> &nbsp;
            <a href="{{ route('compra_productos.index') }}" class="btn btn-danger">Volver</a> 
    </div>
</div>
</form>

<!-- Modal -->
<form name="form_nuevo_producto" id="form_nuevo_producto">
<div class="modal fade" id="nuevo_producto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ingrese datos del Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('compra_productos._form_product')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" id="agregar_nuevo_producto" name="agregar_nuevo_producto">Agregar</button>
            </div>
        </div>
    </div>
</div>
</form>
@stop

@section('css')
<link rel="stylesheet" href="/css/validate.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js'></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

<script>
    document.getElementById("fecha_compra").focus();    
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){

        $('#cuotas').hide();
        $('#fecha_limite').hide();
        $('#nro_cuenta').hide();
        
        $("#basic-form").validate();
        //operaciones en los items de compra
        $("#myTable").on('change','#cantidad', function(){
            var currentRow=$(this).closest("tr");            
            var dataCantidad = currentRow.find("#cantidad").val();
            //alert("dss"+dataCantidad);
            var dataCosto = currentRow.find("#costo").val();
            var stotal = parseInt(dataCantidad)*parseInt(dataCosto);
            currentRow.find(".stotal").html(stotal.toFixed(2));

            var total = 0;
            $('#myTable tbody').find('tr').each(function(i,el){
                total += parseFloat($(this).find('td').eq(4).text());                
            });
            $('#myTable tfoot tr th').eq(1).text(total.toFixed(2));
        });
         $("#myTable").on('change','#costo', function(){
             var currentRow=$(this).closest("tr");
              
             var dataCantidad = currentRow.find("#cantidad").val();
             var dataCosto = currentRow.find("#costo").val();
             var stotal = parseInt(dataCantidad)*parseInt(dataCosto);
             currentRow.find(".stotal").html(stotal.toFixed(2));
            
             var total = 0;
             $('#myTable tbody').find('tr').each(function(i,el){
                total += parseFloat($(this).find('td').eq(4).text());                
             });
             $('#myTable tfoot tr th').eq(1).text(total.toFixed(2));
         });
         //listar productos en el select de manera dinamica
         $('#producto_id').select2({
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' )
        });
        //buscar proveedor con ajax
        $( '#proveedor' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),

            ajax: { 
            url: "{{route('buscar_proveedor.search')}}",
            type: "POST",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    _token:CSRF_TOKEN,
                    search: params.term // search term
                     };
            },
            processResults: function (response) {
                return {
                 results: response,                 
                };
            },
                cache: true
            }
        } ); 
        //creando nuevo producto y guardar en la tabla de la DB
        $("#form_nuevo_producto").on('submit',function(e){
            e.preventDefault();
            $('#form_nuevo_producto').validate();
            let barcodigo = $('#barCodigo').val();
            let categoria_id = $('#categoria_id').val();
            let sub_categoria_id = $('#sub_categoria_id').val();
            let marca_id = $('#marca_id').val();
            let nombre_producto = $('#nombre_producto').val();
            let unidad_producto_id = $('#unidad_producto_id').val();
            let descripcion = $('#descripcion').val();
            
            $.ajax({
                type: "POST",
                url : "{{ route('rproductos.registrar') }}",
                data : {
                    _token: CSRF_TOKEN,
                    barCodigo : barcodigo,
                    categoria_id : categoria_id,
                    sub_categoria_id : sub_categoria_id,
                    marca_id : marca_id,
                    nombre_producto : nombre_producto,
                    unidad_producto_id : unidad_producto_id,
                    descripcion : descripcion,                                      
                },
                success : function (data){
                    //alert(data.ultimo_producto.nombre_producto);
                    var len = data.productos.length;
                    $('#producto_id').html("");
                    $('#producto_id').append('<option value=""></option>');
                    for( var i = 0; i<len; i++){
                        $('#producto_id').append('<option value="'+data.productos[i]['id']+'">'+data.productos[i]['barCodigo']+' s '+data.productos[i]['nombre_producto']+'</option>');
                    }

                    $('#nuevo_producto').modal('hide');
                    $('#form_nuevo_producto')[0].reset();

                    $('#capaproductos').append('<tr> <td><input type="hidden" name="product_id[]" value="'+ data.ultimo_producto.id +'">'+ data.ultimo_producto.nombre_producto +'</td>' +
                                            '<td><input type="number" name="cantidad[]" value="1" id="cantidad" class="cantidad" style="width:100px" required></td>'+
                                            '<td><input type="number" name="costo[]" value="0" id="costo" class="costo" style="width:100px" required></td>' +
                                            '<td><input type="number" name="precio[]" value="0" id="" class="form-control" style="width:100px" required></td>' +
                                            '<td style="text-align: center"><span class="stotal"> </span></td>' +                                           
                                            '<td><a href="javascript:void(0);" class="remove_button"><i class="fa fa-trash" style="color: red"></i></a></td>')                                
                                .append('</tr>');
                },
                error:function(data){
                   // $('#barCodigoErrorMsg').text(response.responseJSON.errors.barcodigo);
                },
            });
        });
        //tipo de pagos
        $('#tipo_pago_id').on('change', function(){
            var id = $('#tipo_pago_id').val();
            if(id == 1){
                $('#cuotas').hide();
                $('#fecha_limite').hide();
                $('#nro_cuenta').hide();
                $('#descuento').show();
            }
            if(id == 2){
                $('#cuotas').show();
                $('#fecha_limite').show();
                $('#nro_cuenta').hide();
                $('#descuento').hide();
            }
            if(id == 3){
                $('#cuotas').hide();
                $('#fecha_limite').hide();
                $('#nro_cuenta').show();
                $('#descuento').hide();
            }
            
        });
    });

    //Agregar items(productos) al detalle de Compra
    document.getElementById("producto_id").onchange = function(){
        var producto_id = document.getElementById("producto_id").value;
        //alert(producto_id);
        $.ajax({
            type:"GET",
            url:"{{ route('buscar_producto.bproducto', 27) }}",
            data:{"id":producto_id},

            success:function(data){
                var html = '';                
                $('#capaproductos').append('<tr> <td><input type="hidden" name="product_id[]" value="'+ data.producto.id +'">'+ data.producto.nombre_producto +'</td>' +
                                            '<td><input type="number" name="cantidad[]" value="1" id="cantidad" class="form-control" style="width:100px" required></td>'+
                                            '<td><input type="number" name="costo[]" value="" id="costo" class="form-control" style="width:100px" required></td>' +
                                            '<td><input type="number" name="precio[]" value="" id="precio" class="form-control" style="width:100px" required></td>' +
                                            '<td style="text-align: center"><span class="stotal"> </span></td>' +                                           
                                            '<td><a href="javascript:void(0);" class="remove_button"><i class="fa fa-trash" style="color: red"></i></a></td>')                                
                                .append('</tr>');
            }
        });

        $('#capaproductos').on('click','.remove_button', function(e){
            //alert('entro');
            e.preventDefault();
            $(this).closest('tr').remove();
            var total = 0;
             $('#myTable tbody').find('tr').each(function(i,el){
                total += parseFloat($(this).find('td').eq(4).text());                
             });
             $('#myTable tfoot tr th').eq(1).text(total);
        });        
    }
</script>
@stop
