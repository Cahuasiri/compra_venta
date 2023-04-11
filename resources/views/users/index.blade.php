@extends('adminlte::page')

@section('title', 'Admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('users.create') }}" class="btn btn-info"><i class="fas fa-plus-circle"></i> Nuevo Usuario</a>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="usuarios">
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
                            <form action="{{ route('users.destroy',$user->id) }}" method="POST" class="formDelete">
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

@stop

@section('js')
    @if(session('eliminar') == 'ok')
        <script>
            Swal.fire(
                'Eliminado!',
                'El Usuario ha sido Eliminado con Exito.',
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
    $('#usuarios').DataTable({
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
            title: 'Esta seguro de Eliminar Usuario?',
            text: "si no lo esta puede cancelar la accion!",
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
