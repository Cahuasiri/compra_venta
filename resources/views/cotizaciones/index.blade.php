@extends('adminlte::page')

@section('title', 'Admin')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap5.min.css">
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"
    />
@stop

@section('content')   
<div class="card">
    <div class="card-header">
        <a href="{{ route('cotizaciones.create') }}" class="btn btn-primary"><i class="bi bi-plus-square-fill"></i> Nueva Cotizacion</a>
    </div>  
    <div class="card-body"></div>
    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              {{Session::get('message')}}
        </div>
    @endif
    <table class="table table-striped" style="width:100%" id="cotizaciones">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">FECHA</th>
            <th scope="col">REFERENCIA</th>
            <th scope="col">CLIENTE</th>
            <th scope="col">ESTADO</th>
            <th scope="col">MONTO TOTAL(BOB)</th>
            <th scope="col">ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cotizaciones as $cotizacione)
            <tr>
                <td>{{ $cotizacione->id }}</td>
                <td>{{ $cotizacione->fecha_cotizacion }}</td>
                <td>{{ $cotizacione->referencia }}</td>
                <td>{{ $cotizacione->cliente->nombre_cliente }}</td>
                <td></td>
                <td style="text-align: center">{{ $cotizacione->total }}</td>
                <td>
                    <form action="{{ route('cotizaciones.destroy',$cotizacione->id)}}" method="POST" class="formDelete">                    
                        <a href="{{ route('cotizaciones.edit', $cotizacione->id) }}" class="btn btn-primary btn-sm" title="editar"><i class="bi bi-pencil-square"></i></a>                     
                        @csrf
                        @method('DELETE')                    
                        <button type="submit" class="btn btn-danger btn-sm" title="borrar">
                            <i class="bi bi-trash text-light"></i></button>                    
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
    @if(session('eliminar') == 'ok')
        <script>
            Swal.fire(
                'Eliminado!',
                'La cotización ha sido Eliminado con Exito.',
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
    $('#cotizaciones').DataTable({
        responsive:true,
        autoWidth:false,
        "order":[[0, 'desc']],
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
            title: 'Esta seguro de Eliminar la Cotización?',
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