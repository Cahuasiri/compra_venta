@extends('adminlte::page')

@section('content_header')
<h4>CREAR SUB-CATEGORIAS</h4>
@stop

@section('content')   
   <form action="{{ route('sub_categorias.store') }}" method="POST">
       @include('sub_categorias._form')
   </form>
@stop