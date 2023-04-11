@extends('adminlte::page')

@section('title', 'Admin')

@section('content')
<form action="{{route('reporte_ventas.create')}}" method="GET" id="form_reportes">

<div class="card card-info mb-2">
    <div class="card-header">
        Gestion de Reportes de Ventas
    </div>
    <div class="card-body">
      <div class="form-check">
        <input class="form-check-input" type="radio" name="reportes" id="diario" value="diario" checked>
        <label class="form-check-label" for="diario">
          Reporte de Hoy
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="reportes" id="semanal" value="semanal">
        <label class="form-check-label" for="semanal">
          Reporte Semanal
        </label>
      </div>

      <div class="form-check">
        <input class="form-check-input" type="radio" name="reportes" id="mensual" value="mensual">
        <label class="form-check-label" for="mensual">
          Reporte Mensual
        </label>
      </div>

      <div class="form-check">
        <input class="form-check-input" type="radio" name="reportes" id="otro" value="otro">
        <label class="form-check-label" for="otro">
          Reporte Otras fechas
        </label>
      </div>
    </div>
    <div class="d-flex justify-content-center mb-2 card-footer">
            <input type="submit" value="GENERAR" class="btn btn-primary"> &nbsp;
    </div>    
</div>
</form>                
@stop

@section('js')

@stop