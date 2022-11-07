@csrf
    <div class="mb-3">
        <label class="form-label">Roles</label>
        <input type="text" class="form-control" name="name" value="{{ 
            old('role', $role->name) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Descripcion</label>
        <textarea class="form-control" id="descripcion" rows="3" name="guard_name">{{ old('guard_name', $role->guard_name) }}</textarea>
    </div>  
      
    <div class="col-auto">
        <a href="{{ route('roles.index') }}" class="btn btn-danger">Cancelar</a>
        <input type="submit" value="Guardar" class="btn btn-primary">
    </div>