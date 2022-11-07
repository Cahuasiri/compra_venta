<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Metodo_pago;

class Metodo_pagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Metodo_pago::create([
            'nombre_pago'      =>  'Efectivo',
            'descripcion'    =>  'Pago en Fisico',
        ]);  
    }
}
