@csrf
    <div class="mb-3">
        <label class="form-label">Nombre Completo</label>
        <input type="text" class="form-control" name="nombre" value="{{$persona->nombre}}">
    </div>

    <div class="mb-3">
        <label class="form-label">CEDULA</label>
        <input type="text" class="form-control" name="cedula" value="{{$persona->cedula}}">
    </div>

    <div class="mb-3">
        <label class="form-label">SEXO</label>
        <input type="text" class="form-control" name="sexo" value="{{$persona->sexo}}">
    </div>

    <div class="mb-3">
        <label class="form-label">EMAIL</label>
        <input type="text" class="form-control" name="email" value="{{$persona->email}}">
    </div>

    <div class="mb-3">
        <label class="form-label">TELEFONO</label>
        <input type="text" class="form-control" name="telefono" value="{{$persona->telefono}}">
    </div>

    <div class="mb-3">
        <label class="form-label">DIRECCION</label>
        <input type="text" class="form-control" name="direccion" value="{{$persona->direccion}}">
    </div>

    <div class="mb-3">
        <label class="form-label">FOTO</label>
        <input type="text" class="form-control" name="foto" value="{{$persona->foto}}">
    </div> 
      
    <div class="col-auto">
        <a href="{{ route('personas.index') }}" class="btn btn-danger">Volver</a>
        <input type="submit" value="Guardar" class="btn btn-primary">
    </div>