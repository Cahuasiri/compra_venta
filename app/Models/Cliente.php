<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    public function cotizaciones(){
        return $this->HasMany(Cotizacione::class);
    }
    public function ventas(){
        return $this->HasMany(Venta::class);
    }

}
