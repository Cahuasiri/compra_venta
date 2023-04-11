@extends('adminlte::page')

@section('title', 'Admin')

@section('css')

@stop

@section('content')   
<div class="card card-info mt-2">
    <div class="card-header">
        <a href="{{ route('categorias.create') }}" class="btn btn-success"><i class="fas fa-plus-circle"></i>Nueva Categoria</a>
    </div>  
    <div class="card-body"></div>
    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              {{Session::get('message')}}
        </div>
    @endif
    <table class="table table-striped" style="width:100%" id="categorias">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">NOMBRE</th>
            <th scope="col">DESCRIPCION</th>
            <th scope="col">ESTADO</th>
            <th scope="col">ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categorias as $categoria)
            <tr>
                <td>{{ $categoria->id }}</td>
                <td>{{ $categoria->nombre }}</td>
                <td>{{ $categoria->descripcion }}</td>
                <td>{{ $categoria->estado }}</td>
                <td>
                    <form action="{{ route('categorias.destroy',$categoria->id) }}" method="POST" class="formDelete">
                        <a href="{{ route('categorias.edit', $categoria) }}" class="btn btn-primary btn-sm" ><i class="fas fa-pencil-alt"></i></a>
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('mSubCategorias.mostrar_subcategorias', $categoria->id) }}" class="btn btn-success btn-sm addSubcategoria">
                            <i class="fas fa-plus-circle"></i></a>
                        </a>
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

<div>
    
</div>
<!-- Modal para agregar el pago de credito -->

<form action="" method="GET" id="formSubcategorias">
@csrf
<div class="modal fade" id="formSubcategoria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Sub-cate</h5>
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
    @if(session('eliminar') == 'ok')
        <script>
            Swal.fire(
                'Eliminado!',
                'La Categoría ha sido Eliminado con Exito.',
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
    $('#categorias').DataTable({
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
            title: 'Esta seguro de Eliminar Categoría?',
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