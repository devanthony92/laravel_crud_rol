<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //lista de permisos
        $permissions = [
            // Productos
            'view products',
            'create products',
            'edit products',
            'delete products',
            'restore products',
            'force-delete products',
            // Usuarios
            'view users',
            'create users',
            'edit users',
            'delete users',

            //Roles
            'manage roles',
        ];

        // Crear permisos en la base de datos
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Crear difenrentes roles
        $adminRole = Role::firstOrCreate(
            ['name' => 'admin', 'guard_name' => 'web'],
            ['description' => 'Tiene control total sobre la aplicación.']
        );

        $sellerRole = Role::firstOrCreate(
            ['name' => 'seller', 'guard_name' => 'web'],
            ['description' => 'Gestiona productos y ventas.']
        );

        $viewerRole = Role::firstOrCreate(
            ['name' => 'viewer', 'guard_name' => 'web'],
            ['description' => 'Solo puede visualizar información.']
        );

        // Asignar permisos a los roles
        $adminRole->givePermissionTo(Permission::all());
        $sellerRole->givePermissionTo(['view products', 'create products', 'edit products','view users']);
        $viewerRole->givePermissionTo(['view products']);

        // Crear usuarios de ejemplo y asignarles roles
        $admin = User::firstOrCreate(
            ['email' => 'anthony@email.com'],
            ['name' => 'Anthony', 'password' => bcrypt('anthony92')]
        );
        $admin->assignRole('admin');

        $seller = User::firstOrCreate(
            ['email' => 'aidan@email.com'],
            ['name' => 'Aidan', 'password' => bcrypt('anthony92')]
        );
        $seller->assignRole('seller');
    }
}
