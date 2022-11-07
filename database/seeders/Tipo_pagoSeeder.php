<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tipo_pago;

class Tipo_pagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipo_pago::create([
            'nombre'      =>  'Efectivo',
        ]);
        Tipo_pago::create([
            'nombre'      =>  'Credito',
        ]);
    }
}
