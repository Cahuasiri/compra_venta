@extends('adminlte::page')

@section('content_header')
<h4>EDITAR SUB CATEGORIAS</h4>
@stop

@section('content') 

<form action="{{ route('sub_categorias.update', $sub_categoria) }}" method="POST">
   @method('PUT')  
   @include('sub_categorias._form')
</form>

@stop