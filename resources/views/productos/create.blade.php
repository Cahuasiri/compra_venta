@extends('adminlte::page')
@section('content') 

<form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data" id="producto_form">
   @include('productos._form')
</form>   
@stop

@section('css')
<!-- css filtro en los select  -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

<!-- css para validar formularios -->
<link rel="stylesheet" href="/css/validate.css">
@stop

@section('js')
<!-- js para filtro en select -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>

<!-- plugins para validar formularios -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script> 
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
