@extends('adminlte::page')

@section('content_header')
<h4>CREAR PERSONAS</h4>
@stop

@section('content')   
<form action="{{ route('personas.store') }}" method="POST">
   @include('personas._form')
</form>   
@stop
