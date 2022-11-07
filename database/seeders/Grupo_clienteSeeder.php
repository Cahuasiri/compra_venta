<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Grupo_cliente;

class Grupo_clienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Grupo_cliente::create([
            'nombre'      =>  'General',
            'porcentaje'    =>  '0.00',
        ]); 
    }
}
