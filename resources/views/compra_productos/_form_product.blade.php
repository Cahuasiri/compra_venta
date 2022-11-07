    <div class="row">
        <div class="col-sm-6">
            <div class="mb-6">
                <label class="form-label">Codigo</label>
                <input type="text" class="form-control" name="barCodigo" value="" id="barCodigo" required>
                <span class="text-danger" id="barCodigoErrorMsg"></span>               
            </div>
            <div class="mb-6">
                <label class="form-label">Categoria</label>
                <select class="form-control" name="categoria_id" id="categoria_id" required>
                    <option value="">Category</option>
                        @foreach($categorias as $categoria)                           
                            <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>                           
                        @endforeach           
                </select>
            </div>
            <div class="mb-6">
                <label class="form-label">Sub Categoria</label>
                <select class="form-control" name="sub_categoria_id" id="sub_categoria_id" required>
                    <option value=""> Sub Category</option>
                        @foreach($sub_categorias as $scategoria)                           
                            <option value="{{$scategoria->id}}">{{$scategoria->nombre}}</option>                           
                        @endforeach           
                </select>
            </div>
            <div class="mb-6">
                <label class="form-label">Marca</label>
                <select class="form-control" name="marca_id" id="marca_id" required>
                    <option value="">Select Brand</option>
                    @foreach($marcas as $marca)
                        <option value="{{$marca->id}}">{{$marca->nombre}}</option>
                    @endforeach            
                </select>
            </div>
            <div class="mb-6">
                <label class="form-label">Nombre Producto</label>
                <input type="text" class="form-control" name="nombre_producto" id="nombre_producto" value="" required>                            
            </div>
            
        </div>
        <div class="col-sm-6">
            <div class="mb-6">
                <label class="form-label">U/Medida</label>
                <select class="form-control" name="unidad_producto_id" id="unidad_producto_id" required>
                    <option value="">Select</option>
                        @foreach($unidad_productos as $unidad)
                            <option value="{{$unidad->id}}">{{$unidad->nombre}}</option>
                        @endforeach            
                </select>
            </div>
            <div class="mb-6">
                <label class="form-label">Slug</label>
                <input type="text" class="form-control" name="slug" value="" id="slug">               
            </div>
            <div class="mb-6">
                <label class="form-label">Descripcion</label>
                <textarea class="form-control" id="descripcion" rows="3" name="descripcion"></textarea>
            </div>         
        </div>        
    </div>