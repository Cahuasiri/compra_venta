@csrf
<div class="card">
    <div class="card-body">
    <div class="mb-3">
        <label class="form-label">Marca</label>
        <span class="text-xs badge badge-danger">@error('nombre') {{ $message }} @enderror</span>
        <input type="text" class="form-control" name="nombre" value="{{ 
                old('nombre', $marca->nombre) }}">
        
    </div>
    <div class="mb-3">
        <label class="form-label">Descripcion</label>
        <span class="text-xs badge badge-danger">@error('descripcion') {{ $message }} @enderror</span>
        <textarea class="form-control" id="descripcion" rows="3" name="descripcion">{{ old('descripcion', $marca->descripcion) }}</textarea>
    </div>  
      
    <div class="col-auto">
        <a href="{{ route('marcas.index') }}" class="btn btn-danger">Cancelar</a>
        <input type="submit" value="Guardar" class="btn btn-primary">
    </div>
    </div>
    
</div>