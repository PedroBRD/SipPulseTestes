<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    private const SYSTEM_ROLES = ['super-adm', 'gestor', 'peao'];

    public function index()
    {
        $roles = Role::query()
            ->where('guard_name', Auth::getDefaultDriver())
            ->with('permissions')
            ->orderBy('name')
            ->get();

        return view('Permissoes.roles.index', compact('roles'));
    }

    public function create()
    {
        $role = new Role(['guard_name' => Auth::getDefaultDriver()]);
        $permissions = $this->permissions();

        return view('Permissoes.roles.form', compact('role', 'permissions'));
    }

    public function show(Role $role)
    {
        $this->ensureGuard($role);
        $role->load('permissions');

        return view('Permissoes.roles.show', compact('role'));
    }

    public function store(Request $request)
    {
        $data = $this->validateRole($request);

        DB::transaction(function () use ($data): void {
            $role = Role::create([
                'name' => $data['name'],
                'guard_name' => Auth::getDefaultDriver(),
                'description' => $data['description'] ?? null,
            ]);

            $this->syncPermissions($role, $data['permissions'] ?? []);
        });

        return redirect()->route('roles.index')->with('success', 'Cargo cadastrado com sucesso.');
    }

    public function edit(Role $role)
    {
        $this->ensureGuard($role);
        $permissions = $this->permissions();

        return view('Permissoes.roles.form', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $this->ensureGuard($role);
        $data = $this->validateRole($request, $role);

        if (in_array($role->name, self::SYSTEM_ROLES, true) && $data['name'] !== $role->name) {
            return back()->withErrors(['name' => 'O nome deste cargo do sistema não pode ser alterado.'])
                ->withInput();
        }

        DB::transaction(function () use ($data, $role): void {
            $role->name = $data['name'];
            $role->description = $data['description'] ?? null;
            $role->save();

            $this->syncPermissions($role, $data['permissions'] ?? []);
        });

        return redirect()->route('roles.index')->with('success', 'Cargo atualizado com sucesso.');
    }

    public function destroy(Role $role)
    {
        $this->ensureGuard($role);

        if ($role->name === 'super-adm') {
            return back()->with('error', 'O cargo super-adm é protegido e não pode ser excluído.');
        }

        if ($role->users()->exists()) {
            return back()->with('error', 'Este cargo está atribuído a usuários e não pode ser excluído.');
        }

        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Cargo excluído com sucesso.');
    }

    private function validateRole(Request $request, ?Role $role = null): array
    {
        $guard = Auth::getDefaultDriver();
        $uniqueName = Rule::unique(config('permission.table_names.roles'), 'name')
            ->where('guard_name', $guard);

        if ($role) {
            $uniqueName->ignore($role->getKey());
        }

        return $request->validate([
            'name' => ['required', 'string', 'max:255', $uniqueName],
            'description' => ['nullable', 'string'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => [
                'integer',
                'distinct',
                Rule::exists(config('permission.table_names.permissions'), 'id')
                    ->where('guard_name', $guard),
            ],
        ]);
    }

    private function permissions()
    {
        return Permission::query()
            ->where('guard_name', Auth::getDefaultDriver())
            ->orderBy('name')
            ->get();
    }

    private function syncPermissions(Role $role, array $permissionIds): void
    {
        $permissions = $role->name === 'super-adm'
            ? $this->permissions()
            : Permission::query()
                ->where('guard_name', Auth::getDefaultDriver())
                ->whereIn('id', $permissionIds)
                ->get();

        $role->syncPermissions($permissions);
    }

    private function ensureGuard(Role $role): void
    {
        abort_unless($role->guard_name === Auth::getDefaultDriver(), 404);
    }
}
