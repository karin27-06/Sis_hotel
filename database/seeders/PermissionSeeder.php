<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        #User
        Permission::create(['name' => 'crear usuarios']);
        Permission::create(['name' => 'editar usuarios']);
        Permission::create(['name' => 'eliminar usuarios']);
        Permission::create(['name' => 'ver usuarios']);
        # Roles
        Permission::create(['name' =>'crear roles']);
        Permission::create(['name' =>'editar roles']);
        Permission::create(['name' =>'eliminar roles']);
        Permission::create(['name' =>'ver roles']);
        # Permisos
        Permission::create(['name' =>'crear permisos']);
        Permission::create(['name' =>'editar permisos']);
        Permission::create(['name' =>'eliminar permisos']);
        Permission::create(['name' =>'ver permisos']);
        #Pisos
        Permission::create(['name' => 'crear pisos']);
        Permission::create(['name' => 'editar pisos']);
        Permission::create(['name' => 'eliminar pisos']);
        Permission::create(['name' => 'ver pisos']);
        #Tipos de habitacion
        Permission::create(['name' => 'crear tipos de habitacion']);
        Permission::create(['name' => 'editar tipos de habitacion']);
        Permission::create(['name' => 'eliminar tipos de habitacion']);
        Permission::create(['name' => 'ver tipos de habitacion']);
    }
}
