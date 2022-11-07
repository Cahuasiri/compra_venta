@extends('adminlte::page')

@section('title', 'Admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('users.create') }}" class="btn btn-info">Nuevo Usuario</a>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                            <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                                <a href="{{ route('users.edit', $user) }}" class="btn btn-outline-primary btn-sm">Cambiar</a>
                                <a href="{{ route('users.show', $user) }}" class="btn btn-outline-success btn-sm">Asignar Rol</a>                            
                                @csrf
                                @method('DELETE')
                                                
                                <button type="submit" class="btn btn-outline-danger btn-sm" title="borrar Usuario">Borrar</button>
                            </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <card class="footer">
            {{$users->links()}}
        </card>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
