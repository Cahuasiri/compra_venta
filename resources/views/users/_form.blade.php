@csrf
<div class="card">
    <div class="card-header">
        Ingrese sus datos
    </div>
    <div class="card-body">
        <div class="row">            
            <div class="col-sm-3"> 
                <label class="form-label">Nombre Usuario</label>
                <span class="text-xs badge badge-danger">@error('name') {{ $message }} @enderror</span>              
                <input type="text" name="name" id="name" value="{{old('name', $user->name) }}" class="form-control">
            </div>
            <div class="col-sm-3"> 
                <label class="form-label">Email</label>
                <span class="text-xs badge badge-danger">@error('email') {{ $message }} @enderror</span>              
                <input type="text" name="email" id="email"  value="{{old('email', $user->email) }}" class="form-control">
            </div>            
            <div class="col-sm-3">
                <label class="form-label">Password</label>
                <span class="text-xs badge badge-danger">@error('password') {{ $message }} @enderror</span>
                <input type="password" name="password" class="form-control">
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