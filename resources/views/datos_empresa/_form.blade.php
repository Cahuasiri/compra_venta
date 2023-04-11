<div class="card card-outline card-primary">
@csrf
<div class="card-body">
    <div class="row">
        <div class="col-sm-8">
            <div class="mb-6">
                <label class="form-label">Nombre Empresa</label>
                <span class="text-xs badge badge-danger">@error('nombre_empresa') {{ $message }} @enderror</span>
                <input type="text" class="form-control" name="nombre_empresa" value="{{ old('nombre_empresa', $datos_empresa->nombre_empresa) }}" id="nombre_empresa" required>               
            </div>
            <div class="row">
                <div class="col-sm-3" >
                    <label class="form-label">CI/NIT</label>
                    <span class="text-xs badge badge-danger">@error('nit') {{ $message }} @enderror</span>
                    <input type="text" class="form-control" name="nit" value="{{ old('nit', $datos_empresa->nit) }}" id="nit" required>
                </div>
                <div class="col-sm-4">
                    <label class="form-label">Correo</label>
                    <span class="text-xs badge badge-danger">@error('nit') {{ $message }} @enderror</span>
                    <input type="text" class="form-control" name="correo" value="{{ old('correo', $datos_empresa->correo) }}" id="correo" required>
                </div>
                <div class="col-sm-3">
                    <label class="form-label">Telefono</label>
                    <span class="text-xs badge badge-danger">@error('telefono') {{ $message }} @enderror</span>
                    <input type="text" class="form-control" name="telefono" value="{{ old('telefono', $datos_empresa->telefono) }}" id="telefono" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Direccion</label>
                <span class="text-xs badge badge-danger">@error('direccion') {{ $message }} @enderror</span>
                <input type="text" class="form-control" name="direccion" value="{{ old('direccion', $datos_empresa->direccion) }}" id="direccion" required>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <label class="form-label">Cod-ref-Compra</label>
                    <span class="text-xs badge badge-danger">@error('compra_referencia') {{ $message }} @enderror</span>
                    <input type="text" class="form-control" name="compra_referencia" value="{{ old('compra_referencia', $datos_empresa->compra_referencia) }}" id="compra_referencia">
                </div>
                <div class="cols-sm-4">
                    <label class="form-label">Cod-ref-Venta</label>
                    <span class="text-xs badge badge-danger">@error('venta_referencia') {{ $message }} @enderror</span>
                    <input type="text" class="form-control" name="venta_referencia" value="{{ old('venta_referencia', $datos_empresa->venta_referencia) }}" id="venta_referencia">
                </div>
                <div class="col-sm-4">
                    <label class="form-label">Cod-ref-Cotizacion</label>
                    <span class="text-xs badge badge-danger">@error('coti_referencia') {{ $message }} @enderror</span>
                    <input type="text" class="form-control" name="coti_referencia" value="{{ old('coti_referencia', $datos_empresa->coti_referencia) }}" id="coti_referencia" required>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <label class="form-label">Moneda</label>
                    <span class="text-xs badge badge-danger">@error('moneda') {{ $message }} @enderror</span>
                    <input type="text" class="form-control" name="moneda" value="{{ old('moneda', $datos_empresa->moneda) }}" id="moneda" required>
                </div>
                <div class="col-sm-8">
                    <label class="form-label">Descripcion</label>
                    <span class="text-xs badge badge-danger">@error('descripcion') {{ $message }} @enderror</span>
                    <textarea class="form-control" id="descripcion" rows="3" name="descripcion">{{ old('descripcion', $datos_empresa->descripcion) }}</textarea>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center mb-2 col-sm-4">
        <div class="mb-3">                    
            <div class="row">
                <div class="">
                    <img src="/{{ $datos_empresa->logo }}" width="300px" height="173px" id="imagenmuestra_" class="rounded float-start">
                </div>
            </div>
            <div class="row">
                <div class="">
                    <label class="form-label">Subir Imagen</label>
                    <input type="file" class="form-control" name="imagen_" id="imagen_" >
                </div>
            </div>
        </div>
        </div>        
    </div>
</div>
<div class="d-flex justify-content-center mb-2 card-footer">
    <input type="submit" value="Guardar" class="btn btn-primary"> &nbsp;
    <a href="{{ route('productos.index') }}" class="btn btn-danger">Volver</a>
</div>
</div>