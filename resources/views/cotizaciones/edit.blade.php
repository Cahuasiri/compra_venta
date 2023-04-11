@extends('adminlte::page')

@section('title', 'Admin')

@section('content')
<div class="card card-outline card-success mt-2">
    <div class="card-header">
        <span>Ingrese sus datos en el formulario</span>
    </div>
    <div class="card-body">
        <form action="{{route('cotizaciones.update', $cotizacion)}}" method="POST" id="form_cotizacion">
        @csrf
        @method('PUT') 
        <div class="row">
            <div class="col-sm-4">
                <label for="">Fecha <span>*</span></label>
                <input type="datetime-local" class="form-control" name="fecha_cotizacion" id="fecha_cotizacion" value="{{$cotizacion->fecha_cotizacion}}" required>
            </div>
            <div class="col-sm-4">
                <label for="">Referencia/Nro. Orden <span>*</span></label>
                <input type="text" class="form-control" name="referencia" value="{{$cotizacion->referencia}}" required>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="input-group mb-3">
                    <div class="input-group-text">
                        Clientes
                    </div>    
                    <select class="form-select" id="cliente_id" data-placeholder="Seleccione Cliente" name="cliente_id" required>
                        <option value=""></option>
                        @foreach($clientes as $cliente)
                            @if($cotizacion->cliente_id == $cliente->id)
                                <option value="{{$cliente->id}}" selected>{{$cliente->nombre_cliente}}</option> 
                            @else
                                <option value="{{$cliente->id}}">{{$cliente->nombre_cliente}}</option>
                            @endif                                     
                        @endforeach
                    </select>
                    <div class="input-group-text">
                        <a href="#" class="btn btn-primary btn-sm"><i class='fas fa-user blue-color'></i></a> &nbsp;
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class='fas fa-plus-square blue-color'></i>
                        </button>
                        <!-- <a href="{{ route('clientes.create') }}" class="btn btn-primary btn-sm"><i class='fas fa-plus-square blue-color'></i></a> -->
                    </div>
                </div>                   
            </div>
        </div>
        <div class="row">             
            <div class="col-sm-12">
            <div class="card card-primary mb-2">
                    <div class="card-header">
                       Agregar los productos para la cotizacion
                    </div>
                    <div class="card-body">              
                        <div class="row">
                            <div class="col-sm-12">
                            <div class="input-group mb-3">                                        
                                <select name="producto_id" id="producto_id" class="form-select" data-placeholder="Seleccione un Producto" disabled>
                                    <option value=""></option>
                                    @foreach($productos as $producto)
                                        <option value="{{$producto->id}}"> {{$producto->barCodigo}} - {{$producto->producto}}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-text">
                                    <a href="#" class="btn btn-primary btn-sm"><i class='fas fa-tags blue-color'></i></a> &nbsp;
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <i class='fas fa-plus-square blue-color'></i>
                                    </button>
                                    <!-- <a href="{{ route('productos.create') }}" class="btn btn-primary btn-sm"></a> -->
                                </div>
                            </div>
                            <div class="card w-100 card-outline card-info" >
                                <div class="card-body"> 
                                <table class="display responsive nowra" width="100%" style="border: 1px;" id="myTable">
                                    <thead style="background-color:#f8f9fa">
                                        <tr style="text-align: center">
                                        <th>Producto (código - Nombre)</th>
                                        <th>Cantidad</th> 
                                        <th>Precio Unitario</th>
                                        <th>SubTotal</th>                        
                                        <th></th>
                                        </tr>                            
                                    </thead>
                                    <tbody id="capaproductos">
                                        @foreach($detalle_cotizaciones as $dcotizacione)                                                                                        
                                            <tr>
                                                <td style="text-align: center"> <input type="hidden" name="detalle_cotizacion_id[]" value="{{$dcotizacione->id}}">
                                                    <input type="hidden" name="product_id[]" value="{{ $dcotizacione->producto_id }}">{{ $dcotizacione->nombre_producto }}</td>
                                                <td style="text-align: center">
                                                    <input type="number" name="cantidad[]" value="{{ $dcotizacione->cantidad }}" id="cantidad" class="cantidad" style="width:50px" min="1" required></td>
                                                <td style="text-align: center"><input type="hidden" name="precio_unitario[]" value="{{ $dcotizacione->precio_unitario }}" id="precio" class="precio" style="width:100px">{{ $dcotizacione->precio_unitario }}</td>
                                                <td style="text-align: center"><span class="stotal"> <?php $stotal=$dcotizacione->precio_unitario*$dcotizacione->cantidad; echo $stotal;?></span></td>
                                                <td></td>
                                            </tr>
                                        @endforeach                                       
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" style="text-align: right">Precio Neto</th>
                                            <th style="text-align: center"><span class="total"> {{$cotizacion->sub_total}}</span></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>                        
                                </table>
                                </div>
                            </div>
                            </div> 
                            <div class="col-sm-4">
                                <div class="input-group mb-3">
                                    <div class="input-group-text">
                                        IVA 13%
                                    </div>    
                                    <input type="text" class="form-control" name="impuesto" id="impuesto" value="{{$cotizacion->impuesto}}" required>
                                    <div class="input-group-text">
                                        <a href="javascript:void(0);" class="iva" id="iva"><i class="fas fa-calculator"></i></a>
                                    </div> 
                                </div>
                            </div>
                            <div class="col-sm-4">
                            <input type="hidden" id="sub_total" class="sub_total" name="sub_total" value="{{$cotizacion->sub_total}}">
                                <div class="input-group mb-3">
                                    <div class="input-group-text">
                                        Descuento
                                    </div>    
                                    <input type="number" class="form-control" name="descuento_porcentaje" id="descuento_porcentaje" value="{{$cotizacion->descuento_porcentaje}}" placeholder="0.0" step="1" min="0" required>
                                    <div class="input-group-text">
                                        %
                                    </div> 
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-group mb-3">
                                    <div class="input-group-text">
                                        PRECIO TOTAL
                                    </div>    
                                    <input type="text" class="form-control" name="total" id="total" value="{{$cotizacion->total}}">
                                    <div class="input-group-text">
                                        BOB
                                    </div> 
                                </div>
                            </div>

                            <div class="form-outline">
                                    <label class="form-label" for="textAreaExample">Alguna observacion</label>
                                    <textarea class="form-control" id="textAreaExample1" rows="2" name="descripcion">{{$cotizacion->descripcion}}</textarea>                                    
                            </div>
                        </div>                            
                    </div>
                </div>                
            </div>
        </div>      
    </div>
    <div class="d-flex justify-content-center mb-2 card-footer">
            <input type="submit" value="Guardar" class="btn btn-primary"> &nbsp;
            <a href="{{ route('cotizaciones.index') }}" class="btn btn-danger">Volver</a> 
    </div>
    </form>
</div>
<!-- Modal -->
<form name="form_nuevo_cliente" id="form_nuevo_cliente">
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ingrese datos del Cliente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            @include('ventas._form_cliente')
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary" id="agregar_nuevo_cliente" name="agregar_nuevo_cliente">Agregar</button>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js'></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

<script>
    document.getElementById("fecha_cotizacion").focus();    
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

     $(document).ready(function(){

        //validar el Formulario
        $("#form_cotizacion").validate();

        //evento en la casilla cantidad
        $("#myTable").on('change','.cantidad', function(){
            //actual tr o fila
            var currentRow=$(this).closest("tr");
            
            var dataCantidad = currentRow.find(".cantidad").val();
            var dataPrecio = currentRow.find(".precio").val();
            var stotal = (parseInt(dataCantidad)*parseInt(dataPrecio)).toFixed(2);
            currentRow.find(".stotal").html(stotal);

            //sumar la fila de subtotal y mostrar
            var sub_total = 0;
            $('#myTable tbody').find('tr').each(function(i,el){
                sub_total += parseFloat($(this).find('td').eq(3).text());                
            });
            $('#myTable tfoot tr th').eq(1).text(sub_total.toFixed(2));  

           //guadar temporalmente en input p_neto
           $('#sub_total').val(sub_total);
           var descuento = $('#descuento_porcentaje').val();
           var monto_desc = parseFloat(sub_total)*parseFloat(descuento)/100;
           var total = parseFloat($('#sub_total').val()) + parseFloat($('#impuesto').val()) - monto_desc;
           $('#total').val(total.toFixed(2));                   
        });

        //operaciones con el descuento
        $("#descuento_porcentaje").on('change', function(){
            var sub_total = $('#sub_total').val();
            var descuento = $('#descuento_porcentaje').val();
            var impuesto = $('#impuesto').val();
            var monto_desc = parseFloat(sub_total)*parseFloat(descuento)/100;
            var monto_pagar = (parseFloat(sub_total) + parseFloat(impuesto)).toFixed(2) - monto_desc;
            $('#total').val(monto_pagar.toFixed(2));            
        });

        //calcular IVA
        $('#iva').on('click', function(){
            var sub_total = $('#sub_total').val();
            var descuento = $('#descuento_porcentaje').val();
            var monto_desc = parseFloat(sub_total)*parseFloat(descuento)/100;
            var iva = (parseFloat(sub_total)*13/100).toFixed(2);            
            $('#impuesto').val(iva);
            var monto_pagar = (parseFloat(sub_total) + parseFloat(iva)).toFixed(2) - monto_desc;
            $('#total').val(monto_pagar);

        });

        $('#producto_id').select2({
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' )
        });

        $( '#cliente_id' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),

            ajax: { 
            url: "{{route('buscar_cliente.search')}}",
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
        $("#form_nuevo_cliente").on('submit',function(e){
            e.preventDefault();
            $('#form_nuevo_cliente').validate();
            let grupo_cliente_id = $('#grupo_cliente_id').val();
            let nombre_empresa = $('#nombre_empresa').val();
            let nombre_cliente = $('#nombre_cliente').val();
            let email = $('#email').val();
            let nit_ci = $('#nit_ci').val();
            let telefono = $('#telefono').val();
            let direccion = $('#direccion').val();
            
            $.ajax({
                type: "POST",
                url : "{{ route('rclientes.registrar_cliente') }}",
                data : {
                    _token: CSRF_TOKEN,
                    grupo_cliente_id : grupo_cliente_id,
                    nombre_empresa : nombre_empresa,
                    nombre_cliente : nombre_cliente,
                    email : email,
                    nit_ci : nit_ci,
                    telefono : telefono,
                    direccion : direccion,                                      
                },
                success : function (data){
                    //alert(data.ultimo_producto.nombre_producto);
                    var len = data.clientes.length;
                    $('#cliente_id').html("");
                    $('#cliente_id').append('<option value=""></option>');
                    for( var i = 0; i<len; i++){
                        $('#cliente_id').append('<option value="'+data.clientes[i]['id']+'">'+data.clientes[i]['nombre_cliente']+' - '+data.clientes[i]['nombre_empresa']+'</option>');
                    }

                    $('#exampleModal').modal('hide');
                    $('#form_nuevo_cliente')[0].reset();
                },
                error:function(data){
                   // $('#barCodigoErrorMsg').text(response.responseJSON.errors.barcodigo);
                },
            });
        });
        
    });

    document.getElementById("producto_id").onchange = function(){

        var producto_id = document.getElementById("producto_id").value;
        //alert(producto_id);
        $.ajax({
            type:"GET",
            url:"{{ route('buscar_producto_venta.bproducto', 27) }}",
            data:{"id":producto_id},

            success:function(data){
                var html = '';                
                $('#capaproductos').append('<tr> <td><input type="hidden" name="product_id[]" value="'+ data.producto.id +'">'+ data.producto.producto +'</td>' +
                                            '<td style="text-align: center"><input type="number" name="cantidad[]" value="1" id="cantidad" class="cantidad" style="width:50px" required></td>'+
                                            '<td style="text-align: center"><input type="hidden" name="precio_unitario[]" id="precio" value="'+data.producto.costoVenta+'" class="precio" style="width:100px">'+data.producto.costoVenta +'</td>' +
                                            '<td style="text-align: center"><span class="stotal">'+data.producto.costoVenta.toFixed(2)+ '</span></td>' +                                           
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
                total += parseFloat($(this).find('td').eq(3).text());                
             });
             $('#myTable tfoot tr th').eq(1).text(total);
        });        
    }
</script>
@stop
