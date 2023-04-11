@extends('adminlte::page')

@section('content')
<form action="{{ route('productos.update', $producto) }}" method="POST" enctype="multipart/form-data" id="producto_form">
   @method('PUT') 
   @include('productos._formedit')
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
</script>
<script>   
    $(document).ready(function() {
        $("#producto_form").validate();
    });

    document.getElementById("barCodigo").focus();

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
</script>

@stop