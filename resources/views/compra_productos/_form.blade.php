<div class="card card-outline card-primary mt-2">
    <div class="card-header">
        <span>Ingrese los datos <strong>COMPRA</strong> en el formulario</span>
    </div>
    <div class="card-body">
        
        <div class="row">
            <div class="col-sm-4">
                <label for="">Fecha <span>*</span></label>
                <input type="date" class="form-control" name="fecha_compra" id="fecha_compra" value="{{$dt}}" required>
            </div>
            <div class="col-sm-4">
                <label for="">Referencia/Nro. Orden <span>*</span></label>
                <input type="text" class="form-control" name="referencia" id="referencia" value="{{$referencia}}" required>
            </div>
            <div class="col-sm-4">
                <label for="">Almacen <span>*</span></label>                
                <select name="almacen_id" id="" class="form-control" required>
                    @foreach($almacenes as $almacene)
                        <option value="{{$almacene->id}}">{{$almacene->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="input-group mb-3">
                    <div class="input-group-text">
                        Proveedores
                    </div>    
                    <select class="form-select" id="proveedor" data-placeholder="Seleccione Proveedor" name="proveedor_id" required>
                        <option value=""></option>
                        @foreach($proveedores as $proveedore)
                            <option value="{{$proveedore->id}}">{{$proveedore->nombre}}</option>                                      
                        @endforeach
                    </select>
                    <div class="input-group-text">
                        <a href="#" class="btn btn-primary btn-sm"><i class='fas fa-user blue-color'></i></a> &nbsp;
                        <a href="{{ route('proveedores.create') }}" class="btn btn-primary btn-sm"><i class='fas fa-plus-square blue-color'></i></a>
                    </div>
                </div>                   
            </div>
        </div>
        <div class="row">             
            <div class="col-sm-12">
            <div class="card card-info mb-2">
                    <div class="card-header">
                       Agregar los productos que van a ingresar al Sistema
                    </div>
                    <div class="card-body">              
                        <div class="row">
                            <div class="col-sm-12">
                            <div class="input-group mb-3">                                        
                                <select name="producto_id" id="producto_id" class="form-select" data-placeholder="Seleccione un Producto">
                                    <option value=""></option>
                                    @foreach($productos as $producto)
                                        <option value="{{$producto->id}}"> {{$producto->barCodigo}} - {{$producto->nombre_producto}}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-text">
                                    <a href="#" class="btn btn-primary btn-sm"><i class='fas fa-tags blue-color'></i></a> &nbsp;
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevo_producto">
                                        <i class='fas fa-plus-square blue-color'></i>
                                    </button>
                                    <!-- <a href="{{ route('productos.create') }}" class="btn btn-primary btn-sm"></a> -->
                                </div>
                            </div>
                            <div class="card w-100 card-outline card-info" >
                                <div class="card-body"> 
                                <table class="display responsive nowra" width="100%" style="border: 1px;" id="myTable">
                                    <thead style="background-color:#f8f9fa">
                                        <tr>
                                        <th>Producto (código - Nombre)</th>
                                        <th>Cantidad</th> 
                                        <th>Precio - Compra)</th>
                                        <th>Precio - Venta</th>
                                        <th>SubTotal</th>                        
                                        <th></th>
                                        </tr>                            
                                    </thead>
                                    <tbody id="capaproductos">                                       
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4" style="text-align: right">Sub_total</th>
                                            <input type="hidden" name="sub_total" id="sub_total" value="">
                                            <th style="text-align: center"><span class="sub_total"> </span></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>                        
                                </table>
                                </div>
                            </div>
                            </div>
                        </div>                            
                    </div>
                    <div class="position-absolute bottom-0 end-0">
                            <div class="input-group mb-3">
                                <div class="input-group-text">
                                    Total
                                </div>    
                                <input type="number" class="form-control" name="total" id="total" value="0" min="0" style="width: 160px;" required>
                                <input type="hidden" class="form-control" name="descuento_mo" id="descuento_mo" min="0" value="0"  style="width: 160px;" required>
                            </div>
                    </div>
                    <br>
            </div>                
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="input-group mb-3">
                    <div class="input-group-text">
                        Tipo pago
                    </div>    
                    <select class="form-control" id="tipo_pago_id" data-placeholder="Seleccione Proveedor" name="tipo_pago_id" required>
                        @foreach($tipo_pagos as $tipo_pago)
                            <option value="{{$tipo_pago->id}}">{{$tipo_pago->nombre}}</option>                                      
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-3" id="cuotas">
                <div class="input-group mb-3">
                    <div class="input-group-text">
                       Nro. Cuotas
                    </div>    
                    <input type="number" class="form-control" name="cuotas" id="cuotas" value="0" step="1" value="0" min="0" required>
                </div>
            </div>
            <div class="col-sm-3" id="fecha_limite">
                <div class="input-group mb-3">
                    <div class="input-group-text">
                       Fec. Limite
                    </div>    
                    <input type="date" class="form-control" name="fecha_limite" id="fecha_limite" value="{{$dt}}" required>
                </div>
            </div>
            <div class="col-sm-6" id="nro_cuenta">
                <div class="input-group mb-3">
                    <div class="input-group-text">
                       Banco y numero de cuenta
                    </div>    
                    <input type="text" class="form-control" name="nro_banco" id="nro_banco" value="" required>
                </div>
            </div>
            <div class="col-sm-6" id="nro_cheque">
                <div class="input-group mb-3">
                    <div class="input-group-text">
                       Nro de Cheque
                    </div>    
                    <input type="text" class="form-control" name="nro_cheque" id="nro_cheque" value="" required>
                </div>
            </div>
            <div class="col-sm-3" id="descuento">
                <div class="input-group mb-3">
                    <div class="input-group-text">
                       Desc. en %
                    </div>    
                    <input type="number" class="form-control" name="descuento_por" id="descuento_por" value="0" step="1" min="0" required>
                </div>
            </div>
        </div>
        <!-- descripcion -->
        <div class="row">
        <div class="form-outline">
            <label class="form-label" for="textAreaExample">Alguna observacion</label>
            <textarea class="form-control" id="textAreaExample1" rows="2" name="descripcion"></textarea>                                    
        </div>
        </div>      
    </div>
    <div class="d-flex justify-content-center mb-2 card-footer">
            <input type="submit" value="Guardar" class="btn btn-primary"> &nbsp;
            <a href="{{ route('compra_productos.index') }}" class="btn btn-danger">Volver</a> 
    </div>
</div>