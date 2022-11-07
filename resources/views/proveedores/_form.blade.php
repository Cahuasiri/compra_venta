<div class="card card-outline card-primary">
    <div class="card-header" style="background:#f0f0f0">
       <h5>Introduzca sus Datos</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6">
                <label class="form-label">Nombre Empresa</label>
                <input type="text" class="form-control" name="nombre" id="nombre" value="{{ $proveedore->nombre }}" required>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <label class="form-label">NIT</label>
                <input type="text" class="form-control" name="nit" value="{{ $proveedore->nit }}" required>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <label class="form-label">Correo</label>
                <input type="text" class="form-control" name="email" value="{{ $proveedore->email }}" required>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <label class="form-label">Telefono</label>
                <input type="text" class="form-control" name="telefono" value="{{ $proveedore->telefono }}">
            </div>
            <div class="col-sm-3">
                <label class="form-label">Direccion</label>
                <input type="text" class="form-control" name="direccion" value="{{ $proveedore->direccion }}">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <label class="form-label">Pais</label>
                <input type="text" class="form-control" name="pais" value="{{ $proveedore->pais }}">
            </div>
            <div class="col-sm-3">
                <label class="form-label">Ciudad</label>
                <input type="text" class="form-control" name="ciudad" value="{{ $proveedore->ciudad }}">
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-sm-6 d-flex justify-content-center mb-2">
                <a href="{{ route('proveedores.index') }}" class="btn btn-danger">Cancelar</a> &nbsp;
                <input type="submit" value="Guardar" class="btn btn-primary">
            </div>
        </div>        
    </div>
</div>

<script>
    document.getElementById("nombre").focus();
</script>