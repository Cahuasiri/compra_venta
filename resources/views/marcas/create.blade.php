@extends('adminlte::page')

@section('content_header')
<h4>CREAR MARCAS</h4>
@stop

@section('content')   
   <form action="{{ route('marcas.store') }}" method="POST">
       @include('marcas._form')
   </form>
@stop
