<div class="card card-outline card-primary">
@csrf
<div class="card-body">
    <div class="row">
        <div class="col-sm-6">
            <div class="mb-6">
                <label class="form-label">Codigo</label>
                <span class="text-xs badge badge-danger">@error('barCodigo') {{ $message }} @enderror</span>
                <input type="text" class="form-control" name="barCodigo" value="{{ old('barCodigo') }}" id="barCodigo" required>               
            </div>
            <div class="mb-3">
                <label class="form-label">Categoria</label>
                <span class="text-xs badge badge-danger">@error('categoria_id') {{ $message }} @enderror</span>
                <select class="selectpicker form-control" name="categoria_id" id="categoria_id" data-live-search="true" required>
                    <option value="">Elija Categoria</option>
                        @foreach($categorias as $categoria)                           
                            <option {{ old('categoria_id') == $categoria->id ? "selected":""}} value="{{$categoria->id}}">{{$categoria->nombre}}</option>                           
                        @endforeach           
                </select>
            </div>
            <div class="mb-3" id="sub">
                <label class="form-label">Sub Categoria</label>
                <select class="selectpicker form-control" name="sub_categoria_id" id="sub_categoria_id" data-live-search="true" required>
                        <option value=""> Elija sub categoria</option>
                        @foreach($sub_categorias as $scategoria)                           
                            <option {{ old('sub_categoria_id') == $scategoria->id ? "selected":""}} value="{{$scategoria->id}}">{{$scategoria->nombre}}</option>                           
                        @endforeach 
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Marca</label>
                <span class="text-xs badge badge-danger">@error('marca_id') {{ $message }} @enderror</span>
                <select class="selectpicker form-control" name="marca_id" data-live-search="true" required>
                    <option value="">Elija Marca</option>
                    @foreach($marcas as $marca)
                        <option {{old('marca_id') == $marca->id ? "selected":""}} value="{{$marca->id}}">{{$marca->nombre}}</option>
                    @endforeach            
                </select>
            </div>
            <div class="row ">
                <div class="col-sm-8">
                    <div class="mb-3">
                        <label class="form-label">Nombre Producto</label>
                        <span class="text-xs badge badge-danger">@error('nombre_producto') {{ $message }} @enderror</span>
                        <input type="text" class="form-control" name="nombre_producto" value="{{old('nombre_producto', $producto->nombre_producto)}}" required>                            
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="mb-3">
                        <label class="form-label">Unidad de Medida</label>
                        <span class="text-xs badge badge-danger">@error('unidad_id') {{ $message }} @enderror</span>
                        <select class="selectpicker form-control" name="unidad_producto_id" data-live-search="true" required>
                            <option value="">Unid. Medida</option>
                            @foreach($unidad_productos as $unidad)
                                <option {{old('unidad_id') == $unidad->id ? "selected":""}} value="{{$unidad->id}}">{{$unidad->nombre}}</option>
                            @endforeach            
                        </select>
                    </div>
                </div>
            </div>
     
            <div class="mb-6">
                <label class="form-label">Descripcion</label>
                <span class="text-xs badge badge-danger">@error('descripcion') {{ $message }} @enderror</span>
                <textarea class="form-control" id="descripcion" rows="3" name="descripcion">{{ old('descripcion', $producto->descripcion) }}</textarea>
            </div>  
        </div>
        <div class="d-flex justify-content-center mb-2 col-sm-6">
        <div class="mb-3">                    
            <div class="row">
                <div class="">
                    <img src="" width="300px" height="300px" id="imagenmuestra" class="rounded float-start">
                </div>
            </div>
            <div class="row">
                <div class="">
                    <label class="form-label">Subir Imagen</label>
                    <input type="file" class="form-control" name="imagen" id="imagen" >
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

<script>
    
</script>
