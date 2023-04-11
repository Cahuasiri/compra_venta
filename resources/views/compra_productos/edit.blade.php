@extends('adminlte::page')

@section('title', 'Admin')

@section('content')
<form action="{{route('compra_productos.update', $compras)}}" method="POST" id="basic-form">
@csrf
@method('PUT')
<div class="card card-outline card-info mt-2">
    <!-- CABECERA -->
    <div class="card-header"> <span>Actualizacion de Datos de <strong>COMPRA</strong> </span></div>
    <!-- CUERPO -->
    <div class="card-body">
        <!-- fecha y referecia -->
        <div class="row">
            <div class="col-sm-4">
                <label for="">Fecha <span>*</span></label>
                <input type="date" class="form-control" name="fecha_compra" value="{{$compras->fecha}}" required>
            </div>
            <div class="col-sm-4">
                <label for="">Referencia/Nro. Orden <span>*</span></label>
                <input type="text" class="form-control" name="referencia" value="{{$compras->referencia}}" required>
            </div>
            <div class="col-sm-4">
                <label for="">Almacen <span>*</span></label>                
                <select name="almacen_id" id="" class="form-control" required>
                @foreach($almacenes as $almacene)
                    @if($almacene->id == $compras->almacen_id)
                        <option value="{{$almacene->id}}" selected>{{$almacene->nombre}}</option>
                    @else
                        <option value="{{$almacene->id}}">{{$almacene->nombre}}</option>
                    @endif
                    
                @endforeach
                </select>
            </div>
        </div>
        <!-- proveedor -->
        <div class="row">
            <div class="col-sm-12">
                <label for="">Proveedor <span>*</span></label>  
                <div class="input-group mb-3">    
                    <select class="form-select" id="proveedor" data-placeholder="Seleccione Proveedor" name="proveedor_id">
                        <option value=""></option>
                        @foreach($proveedores as $proveedore)
                            @if($proveedore->id == $compras->proveedor_id)
                                <option value="{{$proveedore->id}}" selected>{{$proveedore->nombre}}</option>
                            @else
                                <option value="{{$proveedore->id}}">{{$proveedore->nombre}}</option>
                            @endif
                                            
                        @endforeach
                    </select>
                    <div class="input-group-text">
                        <a href="#" class="btn btn-primary btn-sm"><i class='fas fa-user blue-color'></i></a> &nbsp;
                        <a href="{{ route('proveedores.create') }}" class="btn btn-primary btn-sm"><i class='fas fa-plus-square blue-color'></i></a>
                    </div>
                </div>                   
            </div>
        </div>
        <!-- agregar producto -->
        <div class="row">
            <div class="col-sm-12">
            <div class="card card-info mb-2">
                <div class="card-header">
                    Agregar los productos que van a ingresar al Sistema
                </div>
                <div class="card-body"> 
                    <!-- select de productos -->             
                    <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group mb-3">                                        
                            <select name="producto_id" id="producto_id" class="form-select" data-placeholder="Seleccione un Producto" disabled>
                                <option value=""></option>
                                @foreach($productos as $producto)
                                <option value="{{$producto->id}}"> {{$producto->barCodigo}} - {{$producto->nombre_producto}}</option>
                                @endforeach
                            </select>
                            <div class="input-group-text">
                                <a href="#" class="btn btn-primary btn-sm"><i class='fas fa-tags blue-color'></i></a> &nbsp;
                                <a href="{{ route('productos.create') }}" class="btn btn-primary btn-sm"><i class='fas fa-plus-square blue-color'></i></a>
                            </div>
                        </div>
                    </div>
                    </div>
                    <!-- Tabla de productos agregados --> 
                    <div class="row">
                    <div class="col-sm-12">
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
                                        <?php $total = 0;?>
                                            @foreach($detalle_productos as $dproducto)                                                                                        
                                                <tr>
                                                    <td> <input type="hidden" name="detalle_producto_id[]" value="{{$dproducto->id}}">
                                                        <input type="hidden" name="product_id[]" value="{{ $dproducto->producto_id }}">{{ $dproducto->nombre_producto }}</td>
                                                    <td>
                                                        <input type="number" name="cantidad[]" value="{{ $dproducto->cantidad }}" id="cantidad" class="cantidad" style="width:100px" min="1"></td>
                                                    <td><input type="number" name="costo[]" value="{{ $dproducto->costoCompra }}" id="costo" class="costo" style="width:100px" min="0"></td>
                                                    <td><input type="number" name="precio[]" value="{{ $dproducto->costoVenta }}" id="" class="form-control" style="width:100px" min="0"></td>
                                                    <td style="text-align: center"><span class="stotal"><?php $stotal = $dproducto->cantidad*$dproducto->costoCompra; echo $stotal; ?> </span></td>
                                                    <td></td>
                                                </tr>
                                                <?php $total = $total + $stotal; ?>
                                            @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4" style="text-align: right">Totales</th>
                                            <input type="hidden" name="sub_total" id="sub_total" value="{{$compras->sub_total}}">
                                            <th style="text-align: center"><span class="total"> <?php echo $total;?> </span></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>                        
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mb-2 card-footer">
                    <div class="col-sm-3">
                    <div class="input-group mb-0">
                        <div class="input-group-text">
                            Total
                        </div>    
                        <input type="number" class="form-control" name="total" id="total" value="{{$compras->total}}"  style="width: 160px;" min="0" required>
                        <input type="hidden" class="form-control" name="descuento_mo" id="descuento_mo" value="{{$compras->descuento}}"  style="width: 160px;" required>
                    </div>
                    </div>
                </div>                            
            </div>
            </div>
        </div>
        <!-- descuento y totales a pagar -->
        <div class="row">
            <div class="col-sm-3">
            <div class="input-group mb-3">
                <div class="input-group-text">
                    Tipo pago
                </div>    
                <select class="form-control" id="tipo_pago_id" data-placeholder="Seleccione Proveedor" name="tipo_pago_id" required>
                    @foreach($tipo_pagos as $tipo_pago)
                        @if($tipo_pago->id == $compras->tipo_pago_id)
                            <option value="{{$tipo_pago->id}}" selected>{{$tipo_pago->nombre}}</option>
                        @else
                            <option value="{{$tipo_pago->id}}">{{$tipo_pago->nombre}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            </div>
            <div class="col-sm-3" id="fecha_limite">
            <div class="input-group mb-3">
                <div class="input-group-text">
                    Fec. Limite
                </div>    
                <input type="date" class="form-control" name="fecha_limite" id="fecha_limite" value="{{$compras->fecha_limite_pago}}" required>
            </div>
            </div>
            <div class="col-sm-3" id="nro_banco">
            <div class="input-group mb-3">
                <div class="input-group-text">
                    Banco Nro.
                </div>    
                <input type="text" class="form-control" name="nro_banco" id="nro_banco" value="{{$compras->nro_banco}}" required>
            </div>
            </div>
            <div class="col-sm-3" id="nro_cheque">
            <div class="input-group mb-3">
                <div class="input-group-text">
                    Nro de Cheque
                </div>    
                <input type="text" class="form-control" name="nro_cheque" id="nro_cheque" value="{{$compras->nro_cheque}}" required>
            </div>
            </div>
            <div class="col-sm-3" id="descuento">
            <div class="input-group mb-3">
                <div class="input-group-text">
                    Desc. en %
                </div> 
                <?php $descuento_por = $compras->descuento*100/$compras->sub_total; ?>   
                <input type="number" class="form-control" name="descuento_por" id="descuento_por" value="{{$descuento_por}}" step="1" min="0" required>
            </div>
            </div>
        </div>
        <!-- descripcion -->
        <div class="row">
        <div class="form-outline">
            <label class="form-label" for="textAreaExample">Alguna observacion</label>
            <textarea class="form-control" id="textAreaExample1" rows="2" name="descripcion">{{$compras->descripcion}}</textarea>                                    
        </div>
    </div>
    <!-- PIE -->
    <div class="d-flex justify-content-center mb-2 card-footer">
        <input type="submit" value="Guardar" class="btn btn-primary"> &nbsp;
        <a href="{{ route('compra_productos.index') }}" class="btn btn-danger">Volver</a>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js'></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

<script>
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
     $(document).ready(function(){

        $('#fecha_limite').hide();
        $('#nro_banco').hide();
        $('#nro_cheque').hide();

        $("#basic-form").validate();
        var id = $('#tipo_pago_id').val();
        if(id == 3){
            $('#nro_banco').show();
        }
        if(id == 4){
            $('#nro_cheque').show();
        }
        if(id == 2){
            $('#fecha_limite').show();
        }

        $("#myTable").on('change','.cantidad', function(){
            var currentRow=$(this).closest("tr");
            
            var dataCantidad = currentRow.find(".cantidad").val();
            var dataCosto = currentRow.find(".costo").val();
            var stotal = parseInt(dataCantidad)*parseInt(dataCosto);
            currentRow.find(".stotal").html(stotal);

            var total = 0;
            $('#myTable tbody').find('tr').each(function(i,el){
                total += parseFloat($(this).find('td').eq(4).text());                
            });
            $('#myTable tfoot tr th').eq(1).text(total);
            $('#sub_total').val(total);
            $("#total").val(total.toFixed(2));
        });

        $("#myTable").on('change','.costo', function(){
             var currentRow=$(this).closest("tr");
              
             var dataCantidad = currentRow.find(".cantidad").val();
             var dataCosto = currentRow.find(".costo").val();
             var stotal = parseInt(dataCantidad)*parseInt(dataCosto);
             currentRow.find(".stotal").html(stotal);
            
             var total = 0;
             $('#myTable tbody').find('tr').each(function(i,el){
                total += parseFloat($(this).find('td').eq(4).text());                
             });
             $('#myTable tfoot tr th').eq(1).text(total);
             $('#sub_total').val(total);
             $("#total").val(total.toFixed(2));
         });

        $('#producto_id').select2({
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' )
        });

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
        //tipo de pagos
        $('#tipo_pago_id').on('change', function(){
            var id = $('#tipo_pago_id').val();
            if(id == 1){
                $('#fecha_limite').hide();
                $('#nro_banco').hide();
                $('#descuento').show();
                $('#nro_cheque').hide();
                $('#descuento').focus();
            }
            if(id == 2){
                $('#fecha_limite').show();
                $('#nro_banco').hide();
                $('#descuento').show();
                $('#nro_cheque').hide();
                $('#fecha_limite').focus();
            }
            if(id == 3){
                $('#fecha_limite').hide();
                $('#nro_banco').show();
                $('#descuento').show();
                $('#nro_cheque').hide();
                $('#nro_banco').focus();
            }
            if(id == 4){
                $('#fecha_limite').hide();
                $('#nro_banco').hide();
                $('#descuento').show();
                $('#nro_cheque').show();
                $('#nro_cheque').focus();
            }
            
        });
        //operaciones con el descuento
        $("#descuento_por").on('change', function(){
            var sub_total = $('#sub_total').val();
            var descuento = $('#descuento_por').val();
            var monto_desc = parseFloat(sub_total)*parseFloat(descuento)/100;
            $('#descuento_mo').val(monto_desc.toFixed(2));

            var monto_pagar = parseFloat(sub_total) - parseFloat(monto_desc);
            $('#total').val(monto_pagar.toFixed(2));           
        });  
        
    });

    document.getElementById("producto_id").onchange = function(){

        var producto_id = document.getElementById("producto_id").value;
        //alert(producto_id);
        $.ajax({
            type:"GET",
            url:"{{ route('buscar_producto.bproducto', 27) }}",
            data:{"id":producto_id},

            success:function(data){
                var html = '';                
                $('#capaproductos').append('<tr> <td><input type="hidden" name="product_id[]" value="'+ data.producto.id +'">'+ data.producto.producto +'</td>' +
                                            '<td><input type="text" name="cantidad[]" value="1" id="" class="form-control" style="width:100px"></td>'+
                                            '<td><input type="text" name="costo[]" value="" id="" class="form-control" style="width:100px"></td>' +
                                            '<td><input type="text" name="precio[]" value="" id="" class="form-control" style="width:100px"></td>' +                                            
                                            '<td></td>')                                
                                .append('</tr>');
            }
        });

        $('#capaproductos').on('click','.remove_button', function(e){
            //alert('entro');
            e.preventDefault();
            $(this).closest('tr').remove();
        });        
    }
</script>
   
@stop
