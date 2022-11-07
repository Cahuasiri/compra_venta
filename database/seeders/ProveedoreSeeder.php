<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Proveedore;

class ProveedoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Proveedore::create([
            'nombre'         =>  'CORINSA SRL.',
            'nit'            =>   '5621564852',
            'email'          =>  'corinsa@gmail.com',
            'telefono'       =>  '75851235',
            'direccion'      =>   'Barrio Juan XX calle 5 Nro 6',
            'pais'           =>   'Bolivia',
            'ciudad'         =>   'Tarija',
            'estado'         =>   'A'                
        ]);   
    }
}
