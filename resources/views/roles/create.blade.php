@extends('adminlte::page')

@section('content_header')
<h4>CREAR ROLES</h4>
@stop

@section('content')   
   <form action="{{ route('roles.store') }}" method="POST">
       @include('roles._form')
   </form>
@stop
