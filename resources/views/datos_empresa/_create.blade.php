@extends('adminlte::page')
@section('content') 

<form action="{{ route('datos_empresa.store') }}" method="POST" enctype="multipart/form-data" id="datos_empresa_form">
   @include('datos_empresa._form')
</form>   
@stop

@section('css')
<!-- css para validar formularios -->
<link rel="stylesheet" href="/css/validate.css">
@stop

@section('js')

<!-- plugins para validar formularios -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script> 

<script>   
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
            // Asignamos el atributo src a la tag de imagen
            $('#imagenmuestra_').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
        // El listener va asignado al input
    $("#imagen_").change(function() {
        //alert('buscando imagen');
        readURL(this);
    }); 
</script>
@stop
