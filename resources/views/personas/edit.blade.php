@extends('adminlte::page')

@section('content_header')
<h4>EDITAR PERSONAS</h4>
@stop

@section('content')
<form action="{{ route('personas.update', $persona) }}" method="POST">
   @method('PUT') 
   @include('personas._form')
</form>   
@stop