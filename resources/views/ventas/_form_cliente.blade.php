<div class="row">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <label class="form-label">Grupo de Clientes</label>
                <select autofocus class="selectpicker form-control" name="grupo_cliente_id" id="grupo_cliente_id" data-live-search="true" required>
                    <option value=""> Select Grupo Cliente</option>
                    @foreach($grupo_clientes as $grupo_cliente)
                        <option value="{{$grupo_cliente->id}}">{{$grupo_cliente->nombre}}</option> 
                    @endforeach           
                </select>

                <label class="form-label">Empresa *</label>
                <input type="text" class="form-control" name="nombre_empresa" id="nombre_empresa" required value="">

                <label class="form-label">Nombre*</label>
                <input type="text" class="form-control" name="nombre_cliente" id="nombre_cliente" value="" required>

                <label class="form-label">Correo*</label>
                <input type="email" class="form-control" name="email" id="email" value="" required>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <label class="form-label">NIT/CI*</label>
                <input type="text" class="form-control" name="nit_ci" id="nit_ci" value="">

                <label class="form-label">Telefono</label>
                <input type="text" class="form-control" name="telefono" id="telefono" value="">

                <label class="form-label">Dirección</label>
                <input type="text" class="form-control" name="direccion" id="direccion" value="">
            </div>
        </div>
    </div>
</div>