@extends('adminlte::page')

@section('title', 'Admin')

@section('content_header')
    <h3>Reporte de Ventas</h3>
@stop

@section('content')
  <form action="{{ route('reporte_ventas.update', 1) }}" method="POST">
    @csrf
    @method('PUT') 
    <div class="row" id="rango_fechas">
      <div class="col-sm-6">
                
        <div class="input-group mb-3">
          <div class="input-group-text">
            Desde:
          </div>
          <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" value="{{$fecha_inicio}}">
          <div class="input-group-text">
            Hasta:
          </div>
          <input type="date" class="form-control" name="fecha_fin" id="fecha_fin" value="{{$fecha_fin}}">
        </div>
      </div>
      <div class="col-sm-6">
        <div class="input-group mb-3">
          <div class="input-group-text">
            Cliente:
          </div>
            <select class="selectpicker form-control" name="cliente_id" id="cliente_id" data-live-search="true">
                <option value="">Elija cliente</option>
              @foreach($clientes as $cliente)
                @if($cliente->id == $cliente_id)
                  <option value="{{$cliente->id}}" selected>{{$cliente->nombre_cliente}}</option>
                @else
                  <option value="{{$cliente->id}}">{{$cliente->nombre_cliente}}</option>
                @endif
                
              @endforeach
            </select>
          <div class="input-group-text">
            Usuario:
          </div>
            <select class="selectpicker form-control" name="user_id" id="user_id" data-live-search="true">
                <option value="">Elija Usuario</option>
              @foreach($users as $user)
                @if($user->id == $user_id)
                  <option value="{{$user->id}}" selected>{{$user->name}}</option>
                @else
                  <option value="{{$user->id}}">{{$user->name}}</option>
                @endif
              @endforeach
            </select>
            <button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
        </div>
      </div>
    </div>
    <div class="row" id="filtro_avanzado">
      <div class="col-sm-10">
        
      </div>
    </div>
  </form>  
    <div class="table-responsive-sm">
      <table class="table table-striped" id="table_ventas" style="width:100%">
        <thead>
          <tr>
            <th scope="col" class="center">#</th>
            <th scope="col" >Fecha</th>

            <th scope="col" >Factura</th>
            <th scope="col" >Cliente</th>
            <th scope="col" class="text-right">Sub Total</th>

            <th scope="col"  class="text-right">Impueto</th>
            <th scope="col"  class="text-right">Descuento.</th>
            <th scope="col"  class="text-right">Total</th>
            <th scope="col"  class="text-right">User</th>
            <th scope="col" >Referencia</th>
          </tr>
        </thead>
        <tbody id="lista_ventas">
          <?php $contador = 1; $suma_sub_total =0; $suma_impuesto=0; $suma_descuento=0; $suma_total=0;?>
          @foreach($ventas as $venta)
          <tr>
            <td class="text-left">{{ $contador }}</td>

            <td class="item_name">{{ $venta->fecha_venta }}</td>

            <td class="item_name">{{ $venta->nro_factura }}</td>
            <td class="item_name">{{ $venta->cliente}}</td>
            <td class="text-right">{{ $venta->sub_total }}</td>

            <td class="text-right">{{ $venta->impuesto }}</td>
            <td class="text-right">{{ $venta->descuento }}</td>
            <td class="text-right">{{ $venta->total }}</td>
            <td class="text-right"><small><i>{{ $venta->user_name }}</i></small></td>
            <td class="item_desc"><a href=""><small>{{ $venta->nro_referencia }}</small></a></td>
          </tr>
          <?php $contador++;
            $suma_sub_total = $suma_sub_total+$venta->sub_total;
            $suma_impuesto = $suma_impuesto+$venta->impuesto;
            $suma_descuento = $suma_descuento+$venta->descuento;
              $suma_total = $suma_total + $venta->total;?>
          @endforeach
        </tbody>
            
      </table>
    </div>
@stop


@section('css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.bootstrap5.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.bootstrap5.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
    <style>
      .ms-n5 {
        margin-left: -40px;
      }
    </style>
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
    $('#filtro_avanzado').show();

    $('.avanzado').on('click', function(){
      $('#filtro_avanzado').show();
    });

    $('#table_ventas').DataTable({
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
        //para usar los botones
        responsive: "true",
        dom: 'Bfrtilp',
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

