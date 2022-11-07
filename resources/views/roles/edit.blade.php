@extends('adminlte::page')

@section('content_header')
<h4>EDITAR ROLES</h4>
@stop

@section('content') 

<form action="{{ route('roles.update', $role) }}" method="POST">
   @method('PUT')  
   @include('roles._form')
</form>

@stop