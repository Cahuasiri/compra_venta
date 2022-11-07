<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra_producto extends Model
{
    use HasFactory;

    public function proveedore(){
        return $this->belongsTo(Proveedore::class);
    }

    public function productos(){
        return $this->belongsToMany(Producto::class, 'detalle_compras', 'compra_producto_id', 'producto_id');
    }
}
