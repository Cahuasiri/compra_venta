@extends('adminlte::page')

@section('content_header')
<h4>EDITAR CATEGORIAS</h4>
@stop

@section('content') 

<form action="{{ route('categorias.update', $categoria) }}" method="POST">
   @method('PUT')  
   @include('categorias._form')
</form>

@stop