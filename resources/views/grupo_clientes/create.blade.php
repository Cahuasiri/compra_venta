@extends('adminlte::page')

@section('content_header')
<h4>CREAR GRUPO CLIENTES</h4>
@stop

@section('content')   
   <form action="{{ route('grupo_clientes.store') }}" method="POST">
       @include('grupo_clientes._form')
   </form>
@stop
