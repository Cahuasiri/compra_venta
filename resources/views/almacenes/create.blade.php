@extends('adminlte::page')

@section('content')   
<form action="{{ route('almacenes.store') }}" method="POST">
   @include('almacenes._form')
</form>   
@stop
