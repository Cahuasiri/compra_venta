@csrf
<div class="card">
    <div class="card-body">
    <div class="mb-3 col-4">
        <label class="form-label">Categoria</label>
        <span class="text-xs badge badge-danger">@error('categoria_id') {{ $message }} @enderror</span>
        <select autofocus class="selectpicker form-control" name="categoria_id" id="categoria_id" data-live-search="true" required>
                <option value=""> Select Categorias</option>
            @foreach($categorias as $categoria) 
                @if($categoria->id == $sub_categoria->categoria_id)
                    <option {{ old('categoria_id') == $categoria->id ? "selected":""}} value="{{$categoria->id}}" selected>{{$categoria->nombre}}</option> 
                @else
                    <option {{ old('categoria_id') == $categoria->id ? "selected":""}} value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                @endif                         
                                                               
            @endforeach           
        </select>        
    </div>
    <div class="mb-3 col-4">
        <label class="form-label">Nombre</label>
        <span class="text-xs badge badge-danger">@error('nombre') {{ $message }} @enderror</span>
        <input type="text" class="form-control" name="nombre" value="{{ 
                old('nombre', $sub_categoria->nombre) }}">        
    </div>
    <div class="mb-3 col-4">
        <label class="form-label">Descripcion</label>
        <span class="text-xs badge badge-danger">@error('descripcion') {{ $message }} @enderror</span>
        <textarea class="form-control" id="descripcion" rows="3" name="descripcion">{{ old('descripcion', $sub_categoria->descripcion) }}</textarea>
    </div>  
      
    <div class="col-auto">
        <a href="{{ route('sub_categorias.index') }}" class="btn btn-danger">Cancelar</a>
        <input type="submit" value="Guardar" class="btn btn-primary">
    </div>
    </div>
    
</div>