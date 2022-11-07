@extends('adminlte::page')

@section('title', 'Admin')

@section('content_header')
<h4>ADMIN ROLES</h4>
@stop

@section('content')   
    <div>
        <a href="{{ route('roles.create') }}" class="btn btn-primary">Nuevo Rol</a>
    </div>   

    <table class="table table-hover">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">ROLES</th>
            <th scope="col">DESCRIPCION</th>            
            <th scope="col">ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
            <tr>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <td>{{ $role->guard_name }}</td>                
                <td>
                    <form action="{{ route('roles.destroy',$role->id) }}" method="POST">
                        <a href="{{ route('roles.edit', $role) }}" class="text-indigo-600" >Editar</a>
                        <a href="{{ route('roles.show', $role) }}" class="btn btn-outline-success btn-sm">Permisos</a>
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