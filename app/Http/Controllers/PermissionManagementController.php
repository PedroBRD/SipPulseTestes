<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;

class PermissionManagementController extends Controller
{
    private const SYSTEM_PERMISSIONS = ['view', 'create', 'edit', 'delete'];

    public function index()
    {
        $permissions = Permission::query()
            ->where('guard_name', Auth::getDefaultDriver())
            ->with('roles')
            ->orderBy('name')
            ->get();

        return view('Permissoes.permissions.index', compact('permissions'));
    }

    public function create()
    {
        $permission = new Permission(['guard_name' => Auth::getDefaultDriver()]);

        return view('Permissoes.permissions.form', compact('permission'));
    }

    public function store(Request $request)
    {
        $data = $this->validatePermission($request);

        Permission::create([
            'name' => $data['name'],
            'guard_name' => Auth::getDefaultDriver(),
            'description' => $data['description'] ?? null,
        ]);

        return redirect()->route('permissions.index')->with('success', 'Permissão cadastrada com sucesso.');
    }

    public function edit(Permission $permission)
    {
        $this->ensureGuard($permission);

        return view('Permissoes.permissions.form', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $this->ensureGuard($permission);
        $data = $this->validatePermission($request, $permission);

        if (in_array($permission->name, self::SYSTEM_PERMISSIONS, true)
            && $data['name'] !== $permission->name) {
            return back()->withErrors(['name' => 'O nome desta permissão do sistema não pode ser alterado.'])
                ->withInput();
        }

        $permission->name = $data['name'];
        $permission->description = $data['description'] ?? null;
        $permission->save();

        return redirect()->route('permissions.index')->with('success', 'Permissão atualizada com sucesso.');
    }

    public function destroy(Permission $permission)
    {
        $this->ensureGuard($permission);

        if (in_array($permission->name, self::SYSTEM_PERMISSIONS, true)) {
            return back()->with('error', 'As permissões padrão do sistema não podem ser excluídas.');
        }

        if ($permission->roles()->exists() || $permission->users()->exists()) {
            return back()->with('error', 'Esta permissão está em uso e não pode ser excluída.');
        }

        $permission->delete();

        return redirect()->route('permissions.index')->with('success', 'Permissão excluída com sucesso.');
    }

    private function validatePermission(Request $request, ?Permission $permission = null): array
    {
        $guard = Auth::getDefaultDriver();
        $uniqueName = Rule::unique(config('permission.table_names.permissions'), 'name')
            ->where('guard_name', $guard);

        if ($permission) {
            $uniqueName->ignore($permission->getKey());
        }

        return $request->validate([
            'name' => ['required', 'string', 'max:255', $uniqueName],
            'description' => ['nullable', 'string'],
        ]);
    }

    private function ensureGuard(Permission $permission): void
    {
        abort_unless($permission->guard_name === Auth::getDefaultDriver(), 404);
    }
}
