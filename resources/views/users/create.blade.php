@extends('adminlte::page')

@section('content_header')
<h4>Crear Usuarios</h4>
@stop

@section('content')   
<form action="{{ route('users.store') }}" method="POST" id="form_usuario">
   @include('users._form')
</form>   
@stop

@section('css')
<link rel="stylesheet" href="/css/validate.css">
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script>
   $(document).ready(function(){
      $("#form_usuario").validate({
         messages:{
            name:{
               required : "Ingrese nombre completo"
            }
         }
      });
   });
</script>
@stop
