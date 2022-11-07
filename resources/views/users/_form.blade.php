@csrf
<div class="card">
    <div class="card-header">
        Ingrese sus datos
    </div>
    <div class="card-body">
        <div class="row">            
            <div class="col-sm-3"> 
                <label class="form-label">Nombre Usuario</label>              
                <input type="text" name="name" id="name" value="" class="form-control" required>
            </div>
            <div class="col-sm-3"> 
                <label class="form-label">Email</label>              
                <input type="text" name="email" id="email" value="" class="form-control" required>
            </div>            
            <div class="col-sm-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
        </div>
        <div class="row mb-3">            
            <div class="col-sm-6 mt-2">
                <input type="submit" value="Guardar" class="btn btn-primary">    
                <a href="{{ route('users.index') }}" class="btn btn-danger">Volver</a>
            </div> 
        </div>
    </div>
</div>