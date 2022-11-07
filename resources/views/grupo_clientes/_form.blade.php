@csrf
<div class="card">
    <div class="card-body">
    <div class="mb-3">
        <label class="form-label">Nombre Grupo</label>
        <span class="text-xs badge badge-danger">@error('nombre') {{ $message }} @enderror</span>
        <input type="text" class="form-control" name="nombre" value="{{ 
                old('nombre', $grupo_cliente->nombre) }}">
        
    </div>
    <div class="mb-3">
        <label class="form-label">Porcentaje descuento</label>
        <span class="text-xs badge badge-danger">@error('porcentaje') {{ $message }} @enderror</span>
        <input type="text" class="form-control" name="porcentaje" value="{{ 
                old('porcentaje', $grupo_cliente->porcentaje) }}">
        
    </div>
    <div class="col-auto">
        <a href="{{ route('grupo_clientes.index') }}" class="btn btn-danger">Cancelar</a>
        <input type="submit" value="Guardar" class="btn btn-primary">
    </div>
    </div>
    
</div>