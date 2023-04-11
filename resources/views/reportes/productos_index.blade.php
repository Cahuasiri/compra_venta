@extends('adminlte::page')

@section('title', 'Admin')

@section('content_header')
    <h3>Reporte de Productos</h3>
@stop

@section('content')
<form action="{{route('reporte_productos.create')}}" method="GET" id="form_filtro">
  @csrf
  <div class="row">
    <div class="col-sm-12">
      <div class="input-group mb-3">
        <div class="input-group-text">
          Categorias:
        </div>    
        <select name="categoria_id" id="" class="form-control" required>
            <option value="">Elija Categoria</option>
          @foreach($categorias as $categoria)
            <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
           @endforeach
        </select>
        <div class="input-group-text">
          Sub categorias:
        </div>
        <select name="sub_categoria_id" id="" class="form-control" required>
            <option value="">Elija Sub Categorias</option>
          @foreach($sub_categorias as $sub_categoria)
            <option value="{{$sub_categoria->id}}">{{$sub_categoria->nombre}}</option>
          @endforeach
        </select>
        <button type="submit" class="btn btn-info"><i class="fa fa-search"></i>Buscar</button>
      </div>
    </div>
  </div>  
</form>

<form action="">
  <div class="row">
    <div class="col-sm-4">
      <div class="input-group mb-3">
        <div class="input-group-text">
          Tipo Reporte:
        </div>    
        <select name="categoria_id" id="" class="form-control" required>
            <option value="">Elija opcion</option>
            <option value="1">Compra de Productos(Ingreso)</option>
            <option value="1">Venta de Productos(Salida)</option>
        </select>        
      </div>
    </div>
    <div class="col-sm-8">
      2
    </div>
  </div>
</form>
<div class="table-responsive-sm">
          <table class="table table-striped" style="width:100%" id="productos">
            <thead>
                <tr class="primary">
                <th scope="col">#</th>
                <th scope="col">Codigo</th>
                <th scope="col">Categoria</th>
                <th scope="col">Sub cat</th>
                <th scope="col">Marca</th>
                <th scope="col">Producto</th> 
                <th scope="col">u/medida</th>
                <th scope="col">stock</th>      
                </tr>
            </thead>
            <tbody>
            @foreach ($productos as $producto)
                <tr>
                    <td>{{ $producto->id }}</td>
                    <td>{{ $producto->barCodigo }}</td>
                    <td><small>{{ $producto->categoria->nombre }}</small></td>
                    <td>{{ $producto->sub_categoria->nombre }}</td>
                    <td><small>{{ $producto->marca->nombre }}</small></td>
                    <td>{{ $producto->nombre_producto }}</td> 
                    <td class="text-center"><small>{{ $producto->unidad_producto->nombre }}</small></td>
                    <td class="text-center">{{ $producto->stock }}</td>            
                </tr>
            @endforeach
            </tbody>        
          </table>
        </div>
@stop
@section('css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.bootstrap5.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.bootstrap5.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@stop
@section('js')

<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.colVis.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.4.0/js/responsive.bootstrap5.js"></script>
<script>
  $(document).ready(function() {
    
    $('#productos').DataTable({  
        language: {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
			            },
			            "sProcessing":"Procesando...",
        },
        responsive: "true",
        dom: 'Bfrtilp',
        //dom: '<"top"i>rt<"bottom"flp><"clear">',       
        buttons:[ 
            {
              extend:    'excelHtml5',
              text:      '<i class="fas fa-file-excel"></i> ',
              titleAttr: 'Exportar a Excel',
              className: 'btn btn-success'
            },
            {
              extend:    'pdfHtml5',
              text:      '<i class="fas fa-file-pdf"></i> ',
              titleAttr: 'Exportar a PDF',
              className: 'btn btn-danger'
            },
            {
              extend:    'print',
              text:      '<i class="fa fa-print"></i> ',
              titleAttr: 'Imprimir',
              className: 'btn btn-info'
            },
            {
              extend:   'colvis',
              text:     'filtro',
            }
		    ]	        
    });
});
</script>
@stop

