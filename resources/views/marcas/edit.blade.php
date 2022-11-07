@extends('adminlte::page')

@section('content_header')
<h4>EDITAR MARCAS</h4>
@stop

@section('content') 

<form action="{{ route('marcas.update', $marca) }}" method="POST">
   @method('PUT')  
   @include('marcas._form')
</form>

@stop