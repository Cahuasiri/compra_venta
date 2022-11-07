<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    public function marca(){
        return $this->belongsTo(Marca::class);
    }
    
    public function unidad_producto(){
        return $this->belongsTo(Unidad_producto::class);
    }

    public function compra_productos(){

        return $this->belongsToMany(Compra_producto::class, 'detalle_compras', 'compra_producto_id', 'producto_id');
        
    }
}

