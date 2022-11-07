@extends('adminlte::page')

@section('title', 'Admin')

@section('content_header')
<h4>ADMIN PERSONAS</h4>
@stop

@section('content')   
    <div>
        <a href="{{ route('personas.create') }}" class="btn btn-primary">CREAR</a>
    </div>   

    <table class="table table-hover">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">NOMBRE</th>
            <th scope="col">CEDULA</th>
            <th scope="col">SEXO</th>
            <th scope="col">EMAIL</th> 
            <th scope="col">DIRECCION</th>
            <th scope="col">FOTO</th>             
            <th scope="col">ESTADO</th>             
            <th scope="col">ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($personas as $persona)
            <tr>
                <td>{{ $persona->id }}</td>
                <td>{{ $persona->nombre }}</td>
                <td>{{ $persona->cedula }}</td>
                <td>{{ $persona->sexo }}</td>
                <td>{{ $persona->email }}</td> 
                <td>{{ $persona->direccion }}</td>
                <td>{{ $persona->foto }}</td>             
                <td>{{ $persona->estado }}</td>                 
                <td>               
                    <form action="{{ route('personas.destroy',$persona->id) }}" method="POST">                    
                        <a href="{{ route('personas.edit', $persona) }}" class="text-indigo-600" >Editar</a>                     
                        @csrf
                        @method('DELETE')                    
                        <button type="submit" class="btn btn-danger">Borrar</button>                    
                    </form>              
                </td>
            </tr>
            @endforeach
        </tbody>        
    </table>            
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop