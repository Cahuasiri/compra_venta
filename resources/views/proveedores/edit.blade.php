@extends('adminlte::page')

@section('content')
<form action="{{ route('proveedores.update', $proveedore) }}" method="POST" id="proveedor_form">
   @csrf
   @method('PUT') 
   @include('proveedores._form')
</form>   
@stop

@section('css')
    <link rel="stylesheet" href="/css/validate.css">
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
   
    <script>
        $(document).ready(function() {
            $("#proveedor_form").validate();
        });
    </script>
@stop