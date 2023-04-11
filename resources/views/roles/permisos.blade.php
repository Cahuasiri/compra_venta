@extends('adminlte::page')

@section('title', 'Admin')

@section('content') 
@foreach ($roles as $role) 
<form action="{{route('roles.show', $role)}}" method="POST">
@csrf
@method('GET')  
    <div class="card">
        <div class="card-header"> <h4> Asignar Permisos a Modulos </h4></div>
        <div class="card-body">
            <div class="row">
            <div class="sm-mb-2">
                <label class="form-contorl">Rol:</label>
                    {{$role->name}}
                <input type="hidden" name="role_id" value="{{$role->id}}">
            </div>
            </div>
            <div class="row">
                <div class="sm-mb-2">
                    <table class="table table-striped" width="100%">
                        <thead>
                            <th>#</th>
                            <th>Detalle</th>
                            <th>permiso</th>
                        </thead>
                        <tbody>
                            @foreach($permissions as $permission)
                                <?php $ban = 'no';?>
                                <tr>
                                    <td>{{$permission->id}}</td>
                                    <td>{{$permission->name}}</td>
                                    <td text-align:center>
                                        <div class="form-check"> 
                                            @foreach($permisos as $permiso)
                                                @if($permiso->permission_id == $permission->id)
                                                    <?php $ban = 'si';?>
                                                @endif
                                            @endforeach  
                                            <?php if ($ban == 'si') {?>
                                                <input class="form-check-input" type="checkbox" value="{{$permission->id}}" name="permisos[]" checked>
                                            <?php } else {?>
                                                <input class="form-check-input" type="checkbox" value="{{$permission->id}}" name="permisos[]">
                                              <?php } ?>                                     
                                                                               
                                        </div>
                                    </td>
                                </tr>
                            @endforeach                                                    
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-auto">
                <a href="{{ route('roles.index') }}" class="btn btn-danger">Cancelar</a>
                <input type="submit" value="Guardar" class="btn btn-primary">
            </div>
        </div>
    </div>
</form>
@endforeach 
@stop

@section('css')
    
@stop

@section('js')
    
@stop