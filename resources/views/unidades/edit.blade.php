@extends('adminlte::page')

@section('content_header')
<h4>EDITAR UNIDADES</h4>
@stop

@section('content') 

<form action="{{ route('unidades.update', $unidad) }}" method="POST">
   @method('PUT')  
   @include('unidades._form')
</form>

@stop