@csrf
<div class="card">
    <div class="card-body">
    <div class="mb-3 col-4">
        <label class="form-label">Codigo</label>
        <span class="text-xs badge badge-danger">@error('codigo') {{ $message }} @enderror</span>
        <input type="text" class="form-control" name="codigo" value="{{ 
                old('codigo', $unidad->codigo) }}">
    </div>
    <div class="mb-3 col-4">
        <label class="form-label">Nombre</label>
        <span class="text-xs badge badge-danger">@error('nombre') {{ $message }} @enderror</span>
        <input type="text" class="form-control" name="nombre" value="{{ 
                old('nombre', $unidad->nombre) }}">
    </div>
      
    <div class="col-auto">
        <a href="{{ route('unidades.index') }}" class="btn btn-danger">Cancelar</a>
        <input type="submit" value="Guardar" class="btn btn-primary">
    </div>
    </div>
    
</div>