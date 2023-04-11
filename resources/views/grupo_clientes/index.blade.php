@extends('adminlte::page')

@section('title', 'Admin')

@section('css')

@stop

@section('content')   
<div class="card">
    <div class="card-header">
        <a href="{{ route('grupo_clientes.create') }}" class="btn btn-success"><i class="fas fa-plus-circle"></i> Nuevo Grupo Cliente</a>
    </div>  
    <div class="card-body"></div>
    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              {{Session::get('message')}}
        </div>
    @endif
    <table class="table table-striped" style="width:100%" id="grupo_clientes">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">NOMBRE</th>
            <th scope="col">PORCENTAJE</th>
            <th scope="col">ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($grupo_clientes as $grupo_cliente)
            <tr>
                <td>{{ $grupo_cliente->id }}</td>
                <td>{{ $grupo_cliente->nombre }}</td>
                <td>{{ $grupo_cliente->porcentaje }}</td>
                <td>
                    <form action="{{ route('grupo_clientes.destroy',$grupo_cliente->id) }}" method="POST">
                        <a href="{{ route('grupo_clientes.edit', $grupo_cliente) }}" class="btn btn-primary btn-sm" ><i class="fas fa-pencil-alt"></i></a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" title="Borrar cat"
                        onclick="alert('Esta seguro de eliminar?')">
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
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script>
  
<script>
    $('#grupo_clientes').DataTable({
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
</script>

@stop