@extends('adminlte::page')

@section('title', 'Admin')

@section('content_header')
    <h1>Asignar Rol</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <p class="h5">Nombre:</p>
            <p class="form-control">{{$user->name}}</p>
            <p class="h5">
                <strong> Lista de Roles</strong>
            </p>
            <form action="{{ route('asignar.asignar_roles', $user) }}" method="POST">
                @csrf
                @method('GET')
               
                @foreach($roles as $role)
                <?php $ban = 'no'; ?>
                <div>
                    @foreach($users_rol as $user_rol)
                        @if(($user->id == $user_rol->model_id) && ($role->id == $user_rol->role_id))
                            <?php $ban='si'; ?>
                        @endif
                    @endforeach
                    <?php if ($ban == 'si') { ?>
                        <input type="checkbox" name="roles[]" value="{{$role->id}}" class="mr-1" checked>
                   <?php }else{ ?>
                        <input type="checkbox" name="roles[]" value="{{$role->id}}" class="mr-1">
                    <?php } ?>
                    
                    <label>
                        {{ $role->name }}
                    </label>
                </div>
                <php $ban='no'; ?> 
                @endforeach
                <button type="submit" class="btn btn-primary">Asignar Roles</button>
            </form>
        </div>     
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
