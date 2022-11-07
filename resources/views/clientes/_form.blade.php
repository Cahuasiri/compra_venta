@csrf
<div class="card card-outline card-primary">
    <div class="card-header">
        Ingreso datos en el Formulario
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <label class="form-label">Grupo de Clientes</label>
                        <span class="text-xs badge badge-danger">@error('grupo_cliente_id') {{ $message }} @enderror</span>
                        <select autofocus class="selectpicker form-control" name="grupo_cliente_id" id="grupo_cliente_id" data-live-search="true" required>
                            <option value=""> Select Grupo Cliente</option>
                                @foreach($grupo_clientes as $grupo_cliente) 
                                    @if($grupo_cliente->id == $cliente->grupo_cliente_id)
                                        <option {{ old('grupo_cliente_id') == $grupo_cliente->id ? "selected":""}} value="{{$grupo_cliente->id}}" selected>{{$grupo_cliente->nombre}}</option> 
                                    @else
                                        <option {{ old('grupo_cliente_id') == $grupo_cliente->id ? "selected":""}} value="{{$grupo_cliente->id}}">{{$grupo_cliente->nombre}}</option>
                                    @endif                         
                                                               
                                @endforeach           
                        </select>

                        <label class="form-label">Empresa *</label>
                        <span class="text-xs badge badge-danger">@error('nombre_empresa') {{ $message }} @enderror</span>
                        <input type="text" class="form-control" name="nombre_empresa" id="nombre_empresa" required value="{{ 
                        old('nombre_empresa', $cliente->nombre_empresa) }}">

                        <label class="form-label">Nombre*</label>
                        <span class="text-xs badge badge-danger">@error('nombre_cliente') {{ $message }} @enderror</span>
                        <input type="text" class="form-control" name="nombre_cliente" value="{{ 
                        old('nombre_cliente', $cliente->nombre_cliente) }}" required>

                        <label class="form-label">Correo*</label>
                        <span class="text-xs badge badge-danger">@error('email') {{ $message }} @enderror</span>
                        <input type="email" class="form-control" name="email" value="{{ 
                        old('email', $cliente->email) }}" required>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <label class="form-label">NIT/CI*</label>
                        <span class="text-xs badge badge-danger">@error('nit_ci') {{ $message }} @enderror</span>
                        <input type="text" class="form-control" name="nit_ci" value="{{ 
                        old('nit_ci', $cliente->nit_ci) }}">

                        <label class="form-label">Telefono</label>
                        <span class="text-xs badge badge-danger">@error('telefono') {{ $message }} @enderror</span>
                        <input type="text" class="form-control" name="telefono" value="{{ 
                        old('telefono', $cliente->telefono) }}">

                        <label class="form-label">Dirección</label>
                        <span class="text-xs badge badge-danger">@error('direccion') {{ $message }} @enderror</span>
                        <input type="text" class="form-control" name="direccion" value="{{ 
                        old('direccion', $cliente->direccion) }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-3">
            
        </div>
    </div>
    <div class="d-flex justify-content-center mb-2 card-footer">
        <input type="submit" value="Guardar" class="btn btn-primary"> &nbsp;
        <a href="{{ route('clientes.index') }}" class="btn btn-danger">Cancelar</a>         
    </div>
</div>