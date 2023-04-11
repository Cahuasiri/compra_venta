@extends('adminlte::page')

@section('title', 'Admin')

@section('css')

@stop

@section('content')   
<div class="card">
    <div class="card-header">
        <a href="{{ route('unidades.create') }}" class="btn btn-success"><i class="fas fa-plus-circle"></i> Nueva Unidad de Medida</a>
    </div>  
    <div class="card-body"></div>
    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              {{Session::get('message')}}
        </div>
    @endif
    <table class="table table-striped" style="width:100%" id="unidades">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">CODIGO</th>
            <th scope="col">NOMBRE</th>           
            <th scope="col">ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($unidades as $unidad)
            <tr>
                <td>{{ $unidad->id }}</td>
                <td>{{ $unidad->codigo }}</td>
                <td>{{ $unidad->nombre }}</td>
                <td>
                    <form action="{{ route('unidades.destroy',$unidad->id) }}" method="POST" class="formDelete">
                        <a href="{{ route('unidades.edit', $unidad) }}" class="btn btn-primary btn-sm" ><i class="fas fa-pencil-alt"></i></a>
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
                'La unidad de medida ha sido Eliminado con Exito.',
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
    $('#unidades').DataTable({
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
            title: 'Esta seguro de Eliminar Unidad/Medida?',
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