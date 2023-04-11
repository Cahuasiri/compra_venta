@extends('adminlte::page')

@section('content')
<div class="card card-info mt-2">
  <div class="card-header">
    <div class="row">
        <div class="col-9 d-grid gap-2 d-md-flex justify-content-md-center">
            <h2><a href="{{ route('categorias.index') }}"><<</a>&nbsp;&nbsp;</h2>
        <h3>{{$categoria}}</h3></div>
        <div class="col-3 d-grid gap-2 d-md-flex justify-content-md-end">
            <button class="btn btn-success btnCreate" name="categoria_id" value="{{$categoria_id}}"><i class="fas fa-plus-circle"></i>Nueva Sub Categoria</button>
        </div>
    </div>
  </div>
  <div class="card-body">
        @if(Session::has('message'))
            <div class="alert alert-{{Session::get('color')}} alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{Session::get('message')}}
            </div>
        @endif
        <table class="table table-striped" style="width:100%" id="sub_categorias">
        <thead>
            <tr>
            <th scope="col">#</th>
            <!-- <th scope="col">Categoria</th> -->
            <th scope="col">NOMBRE</th>
            <th scope="col">DESCRIPCION</th>
            <th scope="col">ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sub_categorias as $sub_categoria)
            <tr>
                <td>{{ $sub_categoria->id }}</td>
                <!-- <td>{{ $sub_categoria->categoria->nombre }}</td> -->
                <td>{{ $sub_categoria->nombre }}</td>
                <td>{{ $sub_categoria->descripcion }}</td>
                <td>
                    <form action="{{ route('sub_categorias.destroy',$sub_categoria->id) }}" method="POST" id="formDelete">
                        <a href="{{ route('sub_categorias.edit', $sub_categoria) }}" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" title="Borrar sub cat"
                        onclick="alert('Esta seguro de eliminar?')">
                        <i class="fas fa-trash text-light"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>        
        </table>

  </div>
</div>

<!-- Modal CREATE -->
<form action="{{ route('sub_categorias.store') }}" method="POST" id="formCreate">
@csrf  
<div class="modal fade" id="modal_create" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Crear Subcategoria</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="">
            <label for="form-control">Nombre</label>
            <input type="text" class="form-control" name="nombre" value="">
        </div>
        <div>
            <label for="form-control">Descripcion</label>
            <textarea name="descripcion" class="form-control" id="" cols="30" rows="3"></textarea>
            <input type="hidden" class="form-control" id="categoria_id" name="categoria_id" value="">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</form>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $('#sub_categorias').DataTable({
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
    $(document).ready(function () {
        $(document).on('click','.btnCreate', function(){
            var categoria_id = $(this).val();
            // alert(categoria_id);
            $('#modal_create').modal('show');
            $('#categoria_id').val(categoria_id);
        });
    });
</script>

@stop