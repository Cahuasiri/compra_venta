@extends('adminlte::page')

@section('content_header')
<h4>CREAR CATEGORIAS</h4>
@stop

@section('content')   
   <form action="{{ route('categorias.store') }}" method="POST">
       @include('categorias._form')
   </form>
@stop
