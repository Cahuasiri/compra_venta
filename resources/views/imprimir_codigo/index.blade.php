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
    
    </div>    

    <div class="card-body">
        <table class="table table-striped" style="width:100%" id="productos">
            <thead>
                <tr class="primary">
                <th scope="col">#</th>
                <th scope="col">PRODUCTO</th>
                <th scope="col">CODIGO</th>
                <th scope="col">BARRA</th>
                <th scope="col">Cantidad a Imprimir</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($productos as $producto)
                <tr>
                    <td>{{ $producto->id }}</td>
                    <td>{{ $producto->nombre_producto }}</td> 
                    <td>{{ $producto->barCodigo }}</td>
                    <td>{!! DNS1D::getBarcodeHTML($producto->barCodigo, 'PHARMA') !!}</td>            
                    <td> 
                    <form action="{{ route('imprimir_codigos.show',$producto->id) }}" method="GET" class="formImprimir">
                            <!-- <a href="#" class="btn btn-outline-success btn-sm" title="Agregar Variantes">Add</a> --> 
                            @csrf
                            
                            <input type="number" name="cantidad" id="cantidad" value="1" style="width: 60px;">
                                             
                            <button type="submit" class="btn btn-outline-success btn-sm" title="Imprimir"><i class="fas fa-print">Imprimir</i></button>                 
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