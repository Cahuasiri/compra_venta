@extends('adminlte::page')

@section('title', 'Admin')

@section('css')
    
@stop

@section('content')   
<div class="card">
    <div class="card-header">
        <a href="{{ route('compra_productos.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Nueva Compra</a>
    </div>  
    <div class="card-body"></div>
    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              {{Session::get('message')}}
        </div>
    @endif
    <table class="table table-striped" style="width:100%" id="compras">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Fecha</th>
            <th scope="col">Referencia</th>
            <th scope="col">Proveedor</th>
            <th scope="col">Tipo pago</th>
            <th scope="col">Sub total</th>
            <th scope="col">Descuento</th>
            <th scope="col">Pagado</th>
            <th scope="col">Total</th>
            <th scope="col">ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($compras as $compra)
            <tr>
                <td>{{ $compra->id }}</td>
                <td>{{ $compra->fecha }}</td>
                <td>{{ $compra->referencia }}</td>
                <td>{{ $compra->proveedor }}</td>
                <td>{{ $compra->tipo_pago }}</td>
                <td>{{ $compra->sub_total }}</td>
                <td>{{ $compra->descuento }}</td>
                <td>{{ $compra->monto_pagado }}</td>
                <td style="text-align: center">{{ $compra->total }}</td>
                <td>
                 
                    <div class="dropdown">
                        <button class="btn btn-outline-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-cog"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a href="{{ route('compra_productos.edit', $compra->id) }}" class="dropdown-item" title="editar"><i class="fas fa-pencil-alt"></i>&nbsp;Editar</a>
                            <a href="{{ route('compra_productos.show', $compra->id) }}" class="dropdown-item" title="Documento"><i class="fas fa-file-alt"></i>&nbsp;Documento</a>
                            <form action="{{ route('compra_productos.destroy',$compra->id)}}" method="POST" class="formDelete">
                                @csrf
                                @method('DELETE')  
                                <button type="submit" class="btn btn-light" title="Borrar cat">
                                    <i class="fas fa-trash"></i> Eliminar
                                </button>
                            </form>    
                            @if($compra->tipo_pago_id == 2)
                                <div class="dropdown-divider"></div>
                                <button type="button" value="{{$compra->id}}/{{$compra->monto_pagado}}/{{$compra->total}}" class="btn btn-light pagarbtn" title="Pagar" name="pagar{{$compra->id}}"><i class="far fa-money-bill-alt"></i>&nbsp;Pagar Cuotas</button>
                            @endif 
                        </div>
                    </div>
                </form>                  
                </td>
            </tr>
            @endforeach
        </tbody>        
    </table>
    </div>
</div>
<!-- Modal para agregar el pago de credito -->

<form action="{{ route('pagar_credito.registrar_pago', 1) }}" method="GET" id="form1">
@csrf
<div class="modal fade" id="form_pago" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ingrese el pago y fecha</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-sm-6">
                <label for="">Monto <span>*</span></label>
                <input type="number" class="form-control" name="monto_a_pagar" id="monto_a_pagar" value="" required>
            </div>
            <div class="col-sm-6">
                <label for="">Fecha <span>*</span></label>
                <input type="date" class="form-control" name="fecha_pago" id="fecha_pago" value="" required>
                <input type="hidden" class="form-control" name="compra_id" id="compra_id" value="" required>
            </div>
        </div>
        <div>
            Costo total es: &nbsp;<strong class="costo_total"></strong> &nbsp; ya pago &nbsp;<strong class="pagado"></strong>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>
</form>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    @if(session('eliminar') == 'ok')
        <script>
            Swal.fire(
                'Eliminado!',
                'La Compra ha sido Eliminado con Exito.',
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
    $('#compras').DataTable({
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
    $(document).ready(function () {
        $(document).on('click', '.pagarbtn', function () {
            var compra_id = $(this).val();
            var id = compra_id.split("/")[0];
            var monto_pagado = compra_id.split("/")[1];
            var total = compra_id.split("/")[2];

            $('#form_pago').modal('show');
            $('#compra_id').val(id);
            $('.costo_total').html(total);
            $('.pagado').html(monto_pagado);
           
        });
    });

    $('.formDelete').submit( function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Esta seguro de Eliminar La Compra?',
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