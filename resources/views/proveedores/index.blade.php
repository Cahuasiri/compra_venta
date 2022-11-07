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
        <a href="{{ route('proveedores.create') }}" class="btn btn-primary"><i class="bi bi-plus-square-fill"></i> Nuevo Proveedor</a>
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
                <!-- <td>{{ $proveedor->estado }}</td>                  -->
                <td>               
                    <form action="{{ route('proveedores.destroy',$proveedor->id) }}" method="POST">                    
                        <a href="{{ route('proveedores.edit', $proveedor) }}" class="btn btn-primary btn-sm" title="editar"><i class="bi bi-pencil-square"></i></a>                     
                        @csrf
                        @method('DELETE')                    
                        <button type="submit" class="btn btn-danger btn-sm" title="borrar" onclick="alert('Esta seguro de eliminar?')">
                            <i class="bi bi-trash text-light"></i></button>                    
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
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
</script>
@stop