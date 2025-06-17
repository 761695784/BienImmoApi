<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 🛠️ Créer les permissions
        Permission::create(['name' => 'publier-propriete']);
        Permission::create(['name' => 'voir-dashboard']);
        Permission::create(['name' => 'gérer-utilisateurs']);
        // Permission::create(['name' => 'contacter-owner']);

        // 👤 Créer les rôles
        $admin = Role::create(['name' => 'admin']);
        $owner = Role::create(['name' => 'owner']);

        // 🔐 Attribuer les permissions aux rôles
        $admin->givePermissionTo(Permission::all());

        $owner->givePermissionTo([
            'publier-propriete',
        ]);

        // $client->givePermissionTo([
        //     'contacter-owner',
        // ]);
    }
}
