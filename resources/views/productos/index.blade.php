@extends('adminlte::page')

@section('title', 'Admin')

@section('css')
   
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
                        
                        <div class="dropdown">
                            <button class="btn btn-outline-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-cog"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a href="{{ route('productos.show', $producto) }}" class="btn btn-outline-success btn-sm dropdown-item" title="ver Detalle"><i class="fas fa-eye"></i>&nbsp;Ver Detalle</a>
                                <a href="{{ route('productos.edit', $producto) }}" class="btn btn-outline-primary btn-sm dropdown-item" title="Modificar Product/precios"><i class="fas fa-pen"></i>&nbsp;Editar</a>
                                <form action="{{ route('productos.destroy',$producto->id) }}" method="POST" class="formDelete">
                                    @csrf
                                    @method('DELETE')                    
                                    <button type="submit" class="btn btn-outline-danger btn-sm dropdown-item" title="Dar de baja Producto"><i class="fas fa-trash" style="color: #9a3218;"></i>&nbsp;Eliminar</button>                 
                                </form>
                                <div class="dropdown-divider"></div>
                                    <button type="button" value="{{$producto->barCodigo}}/{{$producto->nombre_producto}}/{{$producto->id}}" class="btn btn-light btn-sm imprimirCodigo" title="Imprimir" name="imprimir{{$producto->id}}"><i class="fas fa-print"></i>&nbsp;Cod-Barras</button>
                                    <button type="button" value="{{$producto->id}}/{{$producto->stock}}/{{$producto->nombre_producto}}" class="btn btn-light btn-sm ajustarbtn" title="Ajuste" name="ajuste{{$producto->id}}"><i class="fas fa-cog"></i>&nbsp;Ajuste</button>

                            </div>
                            
                        </div>
                                                          
                    </td>
                </tr>
            @endforeach
            </tbody>        
        </table>
    </div>
</div> 

<!-- Modal -->
<form action="{{ route('imprimir_codigos.show',2) }}" method="GET" class="formImprimir">
@csrf
<div class="modal fade" id="modal_imprimirCodigo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel1">Imprimir Codigo de Barras</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <h5 class="codigo"></h5>
            <div class="input-group mb-3">
                <div class="input-group-text">
                    Cantidad::
                </div>
                <input type="hidden" class="form-control" name="producto_id" id="producto_id" value="" style="width: 160px;">    
                <input type="number" class="form-control" name="cantidad" id="cantidad" value="" step="1" min="1" required>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success"><i class="fas fa-print"></i>&nbsp; Imprimir</button>
      </div>
    </div>
  </div>
</div>
</form>
<!-- MODAL PARA Ajustar -->
<form action="{{ route('ajuste_cantidad.store') }}" method="POST" id="form1">
@csrf
<div class="modal fade" id="AjusteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Modificar Stock</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            </div>
            <div class="modal-body">
                <h4 class="producto"></h4>
                <input type="hidden" class="form-control" name="producto_id_" id="producto_id_" value="" style="width: 160px;">
                <input type="number" class="form-control" name="stock" id="stock" value="" style="width: 160px;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success ajuste_stock">Modificar</button>
                
            </div>
        </div>
    </div>
</div>
</form>

@stop

@section('js')
    @if(session('eliminar') == 'ok')
        <script>
            Swal.fire(
                'Eliminado!',
                'El Producto ha sido Eliminado con Exito.',
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
    $(document).ready(function () {
        $(document).on('click', '.imprimirCodigo', function () {
            var barCodigo = $(this).val();
            var codigo = barCodigo.split("/")[0];
            var nombreProducto = barCodigo.split("/")[1];
            var producto_id = barCodigo.split("/")[2];

            $('#modal_imprimirCodigo').modal('show');
            $('.codigo').html(codigo+" "+nombreProducto);
            $('#producto_id').val(producto_id); 
        });

        //Ajustar Cantidad
        $(document).on('click', '.ajustarbtn', function () {
            var producto_id = $(this).val();
            var id = producto_id.split("/")[0];
            var stock = producto_id.split("/")[1];
            var nombre = producto_id.split("/")[2];

            $('#AjusteModal').modal('show');
            $('#stock').val(stock);
            $('#producto_id_').val(id);
            $('.producto').html("Modifique Stock de: "+nombre);
        });
    });

    $('.formDelete').submit( function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Esta seguro de Eliminar Producto?',
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