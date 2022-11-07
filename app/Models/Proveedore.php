<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedore extends Model
{
    use HasFactory;
    
    public function compra_productos(){
        return $this->HasMany(Compra_producto::class);
    }
}
