<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(AlmaceneSeeder::class);
        $this->call(ProveedoreSeeder::class);
        $this->call(MarcaSeeder::class);
        $this->call(Grupo_clienteSeeder::class);
        $this->call(Metodo_pagoSeeder::class);
        $this->call(Sub_categoriaSeeder::class);
        $this->call(Tipo_pagoSeeder::class);
        $this->call(Unidad_productoSeeder::class);
        $this->call(Datos_empresaSeeder::class);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
