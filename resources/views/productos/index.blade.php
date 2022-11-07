@extends('adminlte::page')

@section('title', 'Admin')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap5.min.css">
@stop

@section('content')  
<div class="card">
    <div class="card-header">
        <a href="{{ route('productos.create') }}" class="btn btn-primary">
<i class='fas fa-plus-square'></i> Nuevo Producto</a>
    </div>    

    <div class="card-body">
    @if(Session::has('message'))
        <div class="alert alert-{{Session::get('color')}} alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              {{Session::get('message')}}
        </div>
    @endif
        <table class="table table-striped" style="width:100%" id="productos">
            <thead>
                <tr class="primary">
                <th scope="col">#</th>
                <th scope="col">IMAGEN</th>
                <th scope="col">CODIGO</th>
                <th scope="col">CATEGORIA</th>
                <th scope="col">MARCA</th>
                <th scope="col">PRODUCTO</th> 
                <th scope="col">U/MEDIDA</th>
                <th scope="col">STOCK</th>      
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($productos as $producto)
                <tr>
                    <td>{{ $producto->id }}</td>
                    <td> <img src="/{{ $producto->imagen }}"  class="img-fluid img-thumbnail" alt="" width="100px" heigth="100px"></td>                
                    <td>{{ $producto->barCodigo }}</td>
                    <td>{{ $producto->categoria->nombre }}</td>
                    <td>{{ $producto->marca->nombre }}</td>
                    <td>{{ $producto->nombre_producto }}</td> 
                    <td>{{ $producto->unidad_producto->nombre }}</td>
                    <td>{{ $producto->stock }}</td>            
                    <td>               
                        <form action="{{ route('productos.destroy',$producto->id) }}" method="POST" class="formEliminar">
                            <!-- <a href="#" class="btn btn-outline-success btn-sm" title="Agregar Variantes">Add</a> --> 
                            <a href="{{ route('productos.show', $producto) }}" class="btn btn-outline-success btn-sm" title="ver Detalle"><i class="fas fa-eye"></i></a>

                            <a href="{{ route('productos.edit', $producto) }}" class="btn btn-outline-primary btn-sm" title="Modificar Product/precios"><i class="fas fa-pen"></i></a>
                            @csrf
                            @method('DELETE')                    
                            <button type="submit" class="btn btn-outline-danger btn-sm" title="Dar de baja Producto"><i class="fas fa-trash"></i></button>                 
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
    <script>$('#productos').DataTable({
        responsive:true,
        autoWidth:false,
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No existen registros - sorry",
            "info": "Mostrando la pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "search": "Buscar:",
            "paginate": {
                'next': "Siguiente",
                'previous':"Anterior"
            }
        }
    });</script>
@stop