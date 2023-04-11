@extends('adminlte::page')
@section('content') 

<form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data" id="producto_form">
   @include('productos._form')
</form>   
@stop

@section('css')
<!-- css para validar formularios -->
<link rel="stylesheet" href="/css/validate.css">
@stop

@section('js')

<script>   
    $(document).ready(function() {
        $("#producto_form").validate();
    });

    document.getElementById("barCodigo").focus();
    //funcion muestra previa de la imagen
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
            // Asignamos el atributo src a la tag de imagen
            $('#imagenmuestra').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
        // El listener va asignado al input
    $("#imagen").change(function() {
        readURL(this);
    }); 

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
