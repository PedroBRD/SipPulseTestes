<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RolePermissionAuthorizationTest extends TestCase
{
    use DatabaseTransactions;

    public function test_guest_is_redirected_from_role_administration_and_user_role_assignment(): void
    {
        $this->get(route('roles.index'))->assertRedirect(route('login'));
        $this->get(route('users.roles.edit', ['user' => 1]))->assertRedirect(route('login'));
    }

    public function test_only_super_adm_can_access_role_administration(): void
    {
        $user = User::factory()->create();
        $user->assignRole(Role::findByName('peao', 'web'));

        $this->actingAs($user)->get(route('roles.index'))->assertForbidden();

        $admin = User::query()->where('email', 'pedro@brd.com')->firstOrFail();
        $this->actingAs($admin)->get(route('roles.index'))->assertOk();
    }

    public function test_user_role_assignment_replaces_the_previous_role(): void
    {
        $admin = User::query()->where('email', 'pedro@brd.com')->firstOrFail();
        $target = User::factory()->create();
        $target->assignRole(Role::findByName('peao', 'web'));
        $gestor = Role::findByName('gestor', 'web');

        $this->actingAs($admin)
            ->get(route('users.roles.edit', $target))
            ->assertOk()
            ->assertSee($target->name)
            ->assertSee('peao');

        $this->actingAs($admin)
            ->put(route('users.roles.update', $target), ['role_id' => $gestor->id])
            ->assertRedirect(route('users.roles.edit', $target));

        $this->assertSame(['gestor'], $target->fresh()->getRoleNames()->all());
    }

    public function test_super_adm_can_create_and_update_a_roles_permissions(): void
    {
        $admin = User::query()->where('email', 'pedro@brd.com')->firstOrFail();
        $view = Permission::findByName('view', 'web');
        $edit = Permission::findByName('edit', 'web');
        $roleName = 'test-role-'.Str::uuid();

        $this->actingAs($admin)
            ->post(route('roles.store'), [
                'name' => $roleName,
                'description' => 'Descrição inicial',
                'permissions' => [$view->id],
            ])
            ->assertRedirect(route('roles.index'));

        $role = Role::findByName($roleName, 'web');
        $this->assertSame(['view'], $role->permissions->pluck('name')->all());

        $this->actingAs($admin)
            ->put(route('roles.update', $role), [
                'name' => $roleName,
                'description' => 'Descrição atualizada',
                'permissions' => [$edit->id],
            ])
            ->assertRedirect(route('roles.index'));

        $role->refresh();
        $this->assertSame('Descrição atualizada', $role->description);
        $this->assertSame(['edit'], $role->permissions->pluck('name')->all());
    }

    public function test_super_adm_can_create_and_update_permissions(): void
    {
        $admin = User::query()->where('email', 'pedro@brd.com')->firstOrFail();
        $permissionName = 'test-permission-'.Str::uuid();

        $this->actingAs($admin)
            ->post(route('permissions.store'), [
                'name' => $permissionName,
                'description' => 'Descrição inicial',
            ])
            ->assertRedirect(route('permissions.index'));

        $permission = Permission::findByName($permissionName, 'web');
        $this->actingAs($admin)
            ->put(route('permissions.update', $permission), [
                'name' => $permissionName,
                'description' => 'Descrição atualizada',
            ])
            ->assertRedirect(route('permissions.index'));

        $this->assertSame('Descrição atualizada', $permission->fresh()->description);
    }

    public function test_records_in_use_cannot_be_deleted(): void
    {
        $admin = User::query()->where('email', 'pedro@brd.com')->firstOrFail();
        $target = User::factory()->create();
        $role = Role::create(['name' => 'test-role-'.Str::uuid(), 'guard_name' => 'web']);
        $permission = Permission::create([
            'name' => 'test-permission-'.Str::uuid(),
            'guard_name' => 'web',
        ]);
        $role->givePermissionTo($permission);
        $target->assignRole($role);

        $this->actingAs($admin)
            ->from(route('roles.index'))
            ->delete(route('roles.destroy', $role))
            ->assertRedirect(route('roles.index'))
            ->assertSessionHas('error');
        $this->assertDatabaseHas('roles', ['id' => $role->id]);

        $this->from(route('permissions.index'))
            ->delete(route('permissions.destroy', $permission))
            ->assertRedirect(route('permissions.index'))
            ->assertSessionHas('error');
        $this->assertDatabaseHas('permissions', ['id' => $permission->id]);
        $this->assertDatabaseHas('users', ['id' => $target->id]);
    }
}
