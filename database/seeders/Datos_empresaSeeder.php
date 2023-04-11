<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Datos_empresa;

class Datos_empresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Datos_empresa::create([
            'nombre_empresa'      =>  'Distribuidora las Churas',
            'nit'                 =>  '5537450019',
            'correo'              =>  'laschuras@gmail.com',
            'telefono'            =>  '591-72976858',
            'direccion'           =>  'av. las Americas nro. 1245',
            'compra_referencia'   =>  'churas-compra-2022/1000',
            'venta_referencia'    =>  'churas-venta-2022/1000',
            'coti_referencia'     =>  'churas-cotizacion-2022/1000',
            'moneda'              =>  'Bs',
            'descripcion'         =>  'Empresa Distribuidora de material de Construccion'                     
        ]);
    }
}
