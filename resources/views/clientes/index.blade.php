@extends('adminlte::page')

@section('title', 'Admin')

@section('css')

@stop

@section('content')   
<div class="card">
    <div class="card-header">
        <a href="{{ route('clientes.create') }}" class="btn btn-success"><i class="fas fa-plus-circle"></i> Nuevo Cliente</a>
    </div>  
    <div class="card-body"></div>
    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              {{Session::get('message')}}
        </div>
    @endif
    <table class="table table-striped" style="width:100%" id="clientes">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">EMPRESA</th>
            <th scope="col">NOMBRE</th>
            <th scope="col">NIT/CI</th>
            <th scope="col">CORREO</th>
            <th scope="col">TELEFONO</th>
            <th scope="col">DIRECCION</th>
            <th scope="col">GRUPO DE CLIENTES</th>
            <th scope="col">ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
            <tr>
                <td>{{ $cliente->id }}</td>
                <td>{{ $cliente->nombre_empresa }}</td>
                <td>{{ $cliente->nombre_cliente }}</td>
                <td>{{ $cliente->nit_ci }}</td>
                <td>{{ $cliente->email }}</td>
                <td>{{ $cliente->telefono }}</td>
                <td>{{ $cliente->direccion }}</td>
                <td>{{ $cliente->grupo_cliente_id }}</td>
                <td>
                    <form action="{{ route('clientes.destroy',$cliente->id) }}" method="POST" class="formDelete">
                        <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-primary btn-sm" ><i class="fas fa-pencil-alt"></i></a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" title="Borrar cat">
                        <i class="fas fa-trash text-light"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>        
    </table>
    </div>
</div>              
@stop

@section('js')
@if(session('eliminar') == 'ok')
    <script>
        Swal.fire(
            'Eliminado!',
            'El Cliente ha sido Eliminado con Exito.',
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
    $('#clientes').DataTable({
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
            title: 'Esta seguro de Eliminar CLIENTE?',
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