<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Unidad_producto;

class Unidad_productoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unidad_producto::create([
            'codigo'      =>  'PZA',
            'nombre'    =>  'Pieza',
        ]);
    }
}
