@extends('adminlte::page')

@section('title', 'Admin')
@section('css')

@stop

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('proveedores.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Nuevo Proveedor</a>
    </div>
    <div class="card-body">
        @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{Session::get('message')}}
            </div>
        @endif
        <table class="table table-striped" style="width:100%" id="proveedores">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">NOMBRE</th>
            <th scope="col">NIT</th>
            <th scope="col">EMAIL</th>
            <th scope="col">TELEFONO</th> 
            <th scope="col">DIRECCION</th>
            <th scope="col">PAIS</th> 
            <th scope="col">CIUDAD</th>
            <!-- <th scope="col">ESTADO</th>              -->
            <th scope="col">ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($proveedores as $proveedor)
            <tr>
                <td>{{ $proveedor->id }}</td>
                <td>{{ $proveedor->nombre }}</td>
                <td>{{ $proveedor->nit }}</td>
                <td>{{ $proveedor->email }}</td>
                <td>{{ $proveedor->telefono }}</td> 
                <td>{{ $proveedor->direccion }}</td>
                <td>{{ $proveedor->pais }}</td> 
                <td>{{ $proveedor->ciudad }}</td>
                <td>               
                    <form action="{{ route('proveedores.destroy',$proveedor->id) }}" method="POST" class="formDelete">                    
                        <a href="{{ route('proveedores.edit', $proveedor) }}" class="btn btn-primary btn-sm" title="editar"><i class="fas fa-pencil-alt"></i></a>                     
                        @csrf
                        @method('DELETE')                    
                        <button type="submit" class="btn btn-danger btn-sm" title="borrar">
                        <i class="fas fa-trash text-light"></i></button>                    
                    </form>              
                </td>
            </tr>
            @endforeach
        </tbody>        
        </table>
    </div>
</div>   
    <div>
        
    </div>   

                
@stop


@section('js')
@if(session('eliminar') == 'ok')
    <script>
        Swal.fire(
            'Eliminado!',
            'El PROVEEDOR ha sido Eliminado con Exito.',
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
    $('#proveedores').DataTable({
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
            title: 'Esta seguro de Eliminar Proveedor?',
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