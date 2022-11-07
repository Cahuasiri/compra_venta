<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sub_categoria;

class Sub_categoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sub_categoria::create([
            'nombre'      =>  'Sub categoria 1',
            'descripcion'    =>  'Pinturas',
        ]);
    }
}
