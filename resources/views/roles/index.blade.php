@extends('adminlte::page')

@section('title', 'Admin')

@section('content_header')

@stop

@section('content')
<div class="card">
    <div class="card-header"> 
        <a href="{{ route('roles.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i>Nuevo Rol</a>
    </div>    
    <div class="card-body">
        <table class="table table-striped" id="roles">
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
                        <form action="{{ route('roles.destroy',$role->id) }}" method="POST" class="formDelete">
                            <a href="{{ route('roles.edit', $role) }}" class="btn btn-outline-primary btn-sm" >Editar</a>
                            <a href="{{ route('roles.show', $role) }}" class="btn btn-outline-success btn-sm">Permisos</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm">Borrar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>        
        </table>
    </div>
</div>            
@stop

@section('css')
    
@stop

@section('js')
@if(session('eliminar') == 'ok')
    <script>
        Swal.fire(
            'Eliminado!',
            'El Rol ha sido Eliminado con Exito.',
            'success'
        )
    </script>
@endif
@if(session('eliminar') == 'no')
    <script>
        Swal.fire(
            'Error!',
            'No se puede eliminar tiene dependencias',
            'error'
        )
    </script>
@endif
<script>
    $('#roles').DataTable({
        responsive:true,
        autoWidth:false,
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No existen registros - sorry",
            "info": "Mostrando la pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "search": "Buscar:",
            "paginate": {
                'next': "Siguiente",
                'previous':"Anterior"
            }
        }
    });
    $('.formDelete').submit( function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Esta seguro de Eliminar Rol?',
            text: "si no lo esta puede cancelar la accion",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Eliminar!',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
            });
    });
</script>
@stop