@extends('adminlte::page')

@section('content_header')
<h4>CREAR UNIDADES</h4>
@stop

@section('content')   
   <form action="{{ route('unidades.store') }}" method="POST">
       @include('unidades._form')
   </form>
@stop
