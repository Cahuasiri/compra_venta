<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{

    public function run()
    {
        User::create([
            'name'      =>  'Administrador',
            'email'     =>  'admin@gmail.com',
            'password'  =>  bcrypt('admin')
        ])->assignRole('Administrador');

        User::create([
            'name'      =>  'Vendedor',
            'email'     =>  'ventas@gmail.com',
            'password'  =>  bcrypt('ventas')
        ])->assignRole('Vendedor');

        //User::factory(5)->create();
    }
}
