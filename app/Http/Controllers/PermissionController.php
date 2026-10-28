<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index(User $user)
    {
        $roles = Role::query()
            ->where('guard_name', Auth::getDefaultDriver())
            ->orderBy('name')
            ->get();
        $roleAtual = $user->roles()
            ->where('guard_name', Auth::getDefaultDriver())
            ->first();

        return view('Permissoes/homePermission', compact('user', 'roles', 'roleAtual'));
    }

    public function vincular(Request $request, User $user)
    {
        $validated = $request->validate([
            'role_id' => [
                'required',
                'integer',
                Rule::exists(config('permission.table_names.roles'), 'id')
                    ->where('guard_name', Auth::getDefaultDriver()),
            ],
        ]);

        $role = Role::query()->findOrFail($validated['role_id']);
        $superAdmin = Role::query()
            ->where('name', 'super-adm')
            ->where('guard_name', Auth::getDefaultDriver())
            ->first();

        if ($superAdmin && $user->hasRole($superAdmin) && $role->isNot($superAdmin)
            && $superAdmin->users()->count() <= 1) {
            return back()->withErrors([
                'role_id' => 'O único usuário super-adm não pode perder o acesso administrativo.',
            ])->withInput();
        }

        $user->syncRoles([$role]);

        return redirect()->route('users.roles.edit', $user)->with('success', 'Cargo atualizado com sucesso!');
    }
}
