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
      
    <script>
        $(document).ready(function() {
            $("#proveedor_form").validate();
        });
    </script>
@stop