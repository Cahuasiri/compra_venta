<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidad_producto extends Model
{
    use HasFactory;

    public function productos(){
        return $this->HasMany(Producto::class);
    }

}
