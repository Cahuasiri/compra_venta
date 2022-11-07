@extends('adminlte::page')

@section('content') 

<form action="{{ route('clientes.update', $cliente) }}" method="POST">
   @method('PUT')  
   @include('clientes._form')
</form>

@stop