<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{

    public function run()
    {
        $role1 = Role::create(['name'=>'Administrador']);
        $role2 = Role::create(['name'=>'Almacenero']);
        $role3 = Role::create(['name'=>'Vendedor']);
        $role4 = Role::create(['name'=>'Gerencia']);

        
        Permission::create(['name' => 'home'])->syncRoles([$role1, $role2, $role3, $role4]);
        
        //crea el permiso categoria.index y lo relaciona con Rol1 y Rol2
        //Categorias
        Permission::create(['name' => 'categorias.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'categorias.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'categorias.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'categorias.destroy'])->syncRoles([$role1]);

        //Productos
        Permission::create(['name' => 'productos.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'productos.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'productos.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'productos.destroy'])->syncRoles([$role1]);

        //Proveedores
        Permission::create(['name' => 'proveedores.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'proveedores.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'proveedores.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'proveedores.destroy'])->syncRoles([$role1]);

        //Compras
        Permission::create(['name' => 'compra_productos.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'compra_productos.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'compra_productos.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'compra_productos.destroy'])->syncRoles([$role1]);

        //ventas
        Permission::create(['name' => 'ventas.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'ventas.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'ventas.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'ventas.destroy'])->syncRoles([$role1]);

        //cotizaciones
        Permission::create(['name' => 'cotizaciones.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'cotizaciones.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'cotizaciones.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'cotizaciones.destroy'])->syncRoles([$role1]);

        //Usuarios
        Permission::create(['name' => 'users.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'users.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'users.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'users.destroy'])->syncRoles([$role1]);

        //Roles
        Permission::create(['name' => 'roles.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'roles.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'roles.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'roles.destroy'])->syncRoles([$role1]);

        //clientes
        Permission::create(['name' => 'clientes.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'clientes.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'clientes.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'clientes.destroy'])->syncRoles([$role1]);

        //grupo_clientes
        Permission::create(['name' => 'grupo_clientes.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'grupo_clientes.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'grupo_clientes.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'grupo_clientes.destroy'])->syncRoles([$role1]);

        //marcas
        Permission::create(['name' => 'marcas.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'marcas.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'marcas.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'marcas.destroy'])->syncRoles([$role1]);

        //unidades
        Permission::create(['name' => 'unidades.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'unidades.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'unidades.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'unidades.destroy'])->syncRoles([$role1]);
    }
}
