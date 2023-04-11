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

<script>
    $(document).ready(function() {
      $("#cliente_form").validate();
    });
</script>

@stop
