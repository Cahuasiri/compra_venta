@extends('adminlte::page')

@section('title', 'Admin')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
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
                <!-- <th scope="col">IMAGEN</th> -->
                <th scope="col">CODIGO</th>
                <th scope="col">CATEGORIA</th>
                <th scope="col">MARCA</th>
                <th scope="col">PRODUCTO</th> 
                <th scope="col">U/MEDIDA</th>
                <th scope="col">STOCK</th>
                <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($productos as $producto)
                <tr>
                    <td>{{ $producto->id }}</td>
                    <!-- <td> 
                         {!! DNS1D::getBarcodeHTML($producto->barCodigo, 'PHARMA') !!}
                        <img src="/{{ $producto->imagen }}"  class="img-fluid img-thumbnail" alt="" width="50px" heigth="50px">
                    </td>                 -->
                    <td>{{ $producto->barCodigo }}</td>
                    <td>{{ $producto->categoria->nombre }}</td>
                    <td>{{ $producto->marca->nombre }}</td>
                    <td>{{ $producto->nombre_producto }}</td> 
                    <td>{{ $producto->unidad_producto->nombre }}</td>
                    <td class="text-center">
                       {{$producto->stock}}
                    </td>        
                    <td>  
                        <button type="button" value="{{$producto->id}}/{{$producto->stock}}/{{$producto->nombre_producto}}" class="btn btn-outline-primary btn-sm ajustarbtn" title="Ajustar" name="ajustar{{$producto->id}}"><i class="fas fa-cog">Ajustar</i></button>                 
                    </td>
                </tr>
            @endforeach
            </tbody>        
        </table>
    </div>
</div>

<!-- {{-- Delete Modal --}} -->
<form action="{{ route('ajuste_cantidad.store') }}" method="POST" id="form1">
@csrf
<div class="modal fade" id="AjusteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modificar Stock</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 class="producto"></h4>
                <input type="hidden" class="form-control" name="producto_id" id="producto_id" value="" style="width: 160px;">
                <input type="number" class="form-control" name="stock" id="stock" value="" style="width: 160px;">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary ajuste_stock">Guardar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
</form>
<!-- {{-- End - Delete Modal --}} -->
@stop

@section('js')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function () {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#productos').DataTable({
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
        });

        $(document).on('click', '.ajustarbtn', function () {
            var producto_id = $(this).val();
            var id = producto_id.split("/")[0];
            var stock = producto_id.split("/")[1];
            var nombre = producto_id.split("/")[2];

            $('#AjusteModal').modal('show');
            $('#stock').val(stock);
            $('#producto_id').val(id);
            $('.producto').html("Modifique Stock de: "+nombre);
        });
    });    
    </script>

@stop