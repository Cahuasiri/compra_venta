<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Almacene;

class AlmaceneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Almacene::create([
            'nombre'      =>  'ALMACEN 1',
            'ubicacion'    =>  'Zona Aeropuerto calle victor paz nro. 2564'                    
        ]);   
    }
}
