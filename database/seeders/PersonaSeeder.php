<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Persona;

class PersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Persona::create([
            'nombre'     =>  'Administrador',
            'cedula'     =>  '5537450',
            'sexo'       =>  'Masculino',
            'email'      =>  'admin@gmail.com',   
        ]);
    }
}
