<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

/*
Exemplos:
- This package allows for users to be associated with permissions and roles. A permission is a specific ability or capability, and a role is a named group of permissions. A Role and a Permission are regular Eloquent models.
    $role = Role::create(['name' => 'writer']);
    $permission = Permission::create(['name' => 'edit articles']);

- A permission can be assigned to a role using either of these methods:
    $role->givePermissionTo($permission);
    $permission->assignRole($role);

- Multiple permissions can be synced to a role using either of these methods:
    $role->syncPermissions($permissions);
    $permission->syncRoles($roles);

- A permission can be removed from a role using either of these methods:
    $role->revokePermissionTo($permission);
    $permission->removeRole($role);

*/

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $guard = 'web';
        $permissionNames = ['view', 'create', 'edit', 'delete'];
        $permissions = [];

        foreach ($permissionNames as $permissionName) {
            $permissions[$permissionName] = Permission::firstOrCreate([
                'name' => $permissionName,
                'guard_name' => $guard,
            ]);
        }

        $superadmRole = Role::firstOrCreate(['name' => 'super-adm', 'guard_name' => $guard]);
        $gestorRole = Role::firstOrCreate(['name' => 'gestor', 'guard_name' => $guard]);
        $peaoRole = Role::firstOrCreate(['name' => 'peao', 'guard_name' => $guard]);

        $superadmRole->syncPermissions(Permission::query()->where('guard_name', $guard)->get());
        $gestorRole->syncPermissions([
            $permissions['view'],
            $permissions['create'],
            $permissions['edit'],
        ]);
        $peaoRole->syncPermissions([$permissions['view']]);

        $admin = User::firstOrCreate(['email' => 'pedro@brd.com'], [
            'name' => 'Pedro Lucas',
            'password' => Hash::make('password'),
        ]);

        $admin->syncRoles([$superadmRole]);

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
