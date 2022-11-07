@extends('adminlte::page')

@section('content')
<form action="{{ route('almacenes.update', $almacene) }}" method="POST">
   @method('PUT') 
   @include('almacenes._form')
</form>   
@stop