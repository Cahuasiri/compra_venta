@csrf
<div class="card">
    <div class="card-header"></div>
    <div class="card-body">
        <div class="mb-3 col-4">
            <label class="form-label">Nombre Almacen</label>
            <span class="text-xs badge badge-danger">@error('nombre') {{ $message }} @enderror</span>
            <input type="text" class="form-control" name="nombre" value="{{ old('nombre', $almacene->nombre) }}">
        </div>
        <div class="mb-3 col-4">
            <label class="form-label">Ubicacion</label>
            <span class="text-xs badge badge-danger">@error('ubicacion') {{ $message }} @enderror</span>
            <textarea class="form-control" id="ubicacion" rows="3" name="ubicacion">{{ old('ubicacion', $almacene->ubicacion) }}</textarea>
        </div> 
    </div>
    <div class="card-footer">
        <a href="{{ route('almacenes.index') }}" class="btn btn-danger">Cancelar</a>
        <input type="submit" value="Guardar" class="btn btn-primary">
    </div>
</div>
