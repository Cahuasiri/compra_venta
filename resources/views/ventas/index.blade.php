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
        <a href="{{ route('ventas.create') }}" class="btn btn-primary"><i class="bi bi-plus-square-fill"></i> Nueva Venta</a>
    </div>  
    <div class="card-body"></div>
    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              {{Session::get('message')}}
        </div>
    @endif
    <table class="table table-striped" style="width:100%" id="ventas">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">FECHA</th>
            <th scope="col">REFERENCIA</th>
            <th scope="col">FACTURA</th>
            <th scope="col">CLIENTE</th>
            <th scope="col">M/PAGO</th>
            <th scope="col">TOTAL(BOB)</th>
            <th scope="col">ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ventas as $venta)
            <tr>
                <td>{{ $venta->id }}</td>
                <td>{{ $venta->fecha_venta }}</td>
                <td>{{ $venta->nro_referencia }}</td>
                <td>{{ $venta->nro_factura }}</td>
                <td>{{ $venta->cliente }}</td>
                <td>{{ $venta->metodo_pago }}</td>
                <td style="text-align: center">{{ $venta->total }}</td>
                <td>
                    <form action="{{ route('ventas.destroy',$venta->id)}}" method="POST" class="formDelete">                    
                        <a href="{{ route('ventas.edit', $venta->id) }}" class="btn btn-primary btn-sm" title="editar"><i class="bi bi-pencil-square"></i></a>
                        <a href="{{ route('ventas.show', $venta->id) }}" class="btn btn-success btn-sm" title="Detalle"><i class="fas fa-file-alt"></i></a>                     
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
                'La Venta ha sido Eliminado con Exito.',
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
    $('#ventas').DataTable({
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
            title: 'Esta seguro de Eliminar la Venta?',
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