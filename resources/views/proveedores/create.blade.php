@extends('adminlte::page')


@section('content')   
<form action="{{ route('proveedores.store') }}" method="POST" id="proveedor_form">
   @csrf
   @include('proveedores._form')
</form>   
@stop

@section('css')
    <link rel="stylesheet" href="/css/validate.css">
@stop

@section('js')
   
    <script>
        $(document).ready(function() {
            $("#proveedor_form").validate();
        });
    </script>
@stop
