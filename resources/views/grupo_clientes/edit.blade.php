@extends('adminlte::page')

@section('content_header')
<h4>EDITAR GRUPO CLIENTES</h4>
@stop

@section('content') 

<form action="{{ route('grupo_clientes.update', $grupo_cliente) }}" method="POST">
   @method('PUT')  
   @include('grupo_clientes._form')
</form>

@stop