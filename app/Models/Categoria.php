<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',       
    ];

    public function productos(){
        return $this->HasMany(Producto::class);
    }

    public function sub_categorias(){
        return $this->HasMany(Sub_categoria::class);
    }

}
