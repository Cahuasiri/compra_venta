@extends('adminlte::page')

@section('title', 'Admin')

@section('content')
<form action="{{route('compra_productos.store')}}" method="POST" id="basic-form">
@csrf
@include('compra_productos._form')
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
        $('#nro_cheque').hide();
        
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
            $('#sub_total').val(total);
            $("#total").val(total.toFixed(2));
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
             $('#sub_total').val(total);
             $("#total").val(total.toFixed(2));
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
                $('#nro_cheque').hide();
                $('#descuento').focus();
            }
            if(id == 2){
                $('#cuotas').hide();
                $('#fecha_limite').show();
                $('#nro_cuenta').hide();
                $('#descuento').show();
                $('#nro_cheque').hide();
                $('#fecha_limite').focus();
            }
            if(id == 3){
                $('#cuotas').hide();
                $('#fecha_limite').hide();
                $('#nro_cuenta').show();
                $('#descuento').show();
                $('#nro_cheque').hide();
                $('#nro_cuenta').focus();
            }
            if(id == 4){
                $('#cuotas').hide();
                $('#fecha_limite').hide();
                $('#nro_cuenta').hide();
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
                var ban=0;
                var product_ids = document.getElementsByName('product_id[]');
                for (var i = 0; i <product_ids.length; i++) {
                    var product_id = product_ids[i];
                    if(data.producto.id == product_id.value){
                        ban=1;
                    }
                }
                if(ban==0){                    
                    $('#capaproductos').append('<tr> <td><input type="hidden" name="product_id[]" value="'+ data.producto.id +'">'+ data.producto.nombre_producto +'</td>' +
                                                '<td><input type="number" name="cantidad[]" value="1" id="cantidad" class="form-control" style="width:100px" min="1" required></td>'+
                                                '<td><input type="number" name="costo[]" value="" id="costo" class="form-control" style="width:100px" min="0" required></td>' +
                                                '<td><input type="number" name="precio[]" value="" id="precio" class="form-control" style="width:100px" min="0" required></td>' +
                                                '<td style="text-align: center"><span class="stotal"> </span></td>' +                                           
                                                '<td><a href="javascript:void(0);" class="remove_button"><i class="fa fa-trash" style="color: red"></i></a></td>')                                
                                    .append('</tr>');
                }
                else{
                    alert("El Producto "+data.producto.nombre_producto+" ya Existe!");
                }
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

    $("#categoria_id").on('change',function(e){
            e.preventDefault();
        var categoria_id = document.getElementById("categoria_id").value;
        //alert(categoria_id);
        $.ajax({
            type:"GET",
            url:"{{ route('subCategoriasPorCategoria.listaSubcatPorCategoria',27) }}",
            data:{"id":categoria_id},

            success:function(data){
                var len = data.subCategorias.length;
                $('#sub').html("");
                $('#sub').append('<label class="form-label">Sub Categoria</label>');
                $('#sub').append('<select class="form-control" name="sub_categoria_id" id="sub_categoria_id">'); 
                for( var i = 0; i<len; i++){
                    $('#sub_categoria_id').append('<option value="'+data.subCategorias[i]['id']+'">'+data.subCategorias[i]['nombre']+'</option>');
                }    
                $('#sub').append('</select>');
            }
        });
    }); 
</script>
@stop
