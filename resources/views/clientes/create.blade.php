@extends('adminlte::page')

@section('content')   
   <form action="{{ route('clientes.store') }}" method="POST" id="cliente_form">
       @include('clientes._form')
   </form>
@stop

@section('css')
<!-- css para validar formularios -->
<link rel="stylesheet" href="/css/validate.css">
@stop

@section('js')
<!-- plugins para validar formularios -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script> 

<script>
    $(document).ready(function() {
      $("#cliente_form").validate();
    });
</script>

@stop
