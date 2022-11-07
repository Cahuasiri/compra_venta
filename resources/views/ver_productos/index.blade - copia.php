@extends('adminlte::page')

@section('title', 'Admin')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="d-flex justify-content-end col-sm-3">
                <label for="form-control">Producto:</label>
            </div>
            <div class="col-sm-9">
            <form action="{{route('verproductos.create')}}" method="POST">
                @csrf
                @method('GET')
                <select name="producto_id" id="producto_id" class="brand-search-autocomplete form-control" onchange="this.form.submit()">
                    <option value="">Seleccione producto</option>
                    @foreach($productos as $producto)
                        <option value="{{$producto->id}}"> {{$producto->barCodigo}} - {{$producto->producto}}</option>
                    @endforeach
                </select>  
            </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        
    </div>
    <div class="card-footer">

    </div>
</div>
    
@stop

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.brand-search-autocomplete').select2();
        });
    </script>
@stop