@extends('layouts.app')

@section('title', ($role->exists ? 'Editar Cargo' : 'Novo Cargo') . ' | SipPulseTestes')

@section('content')
    <header class="topbar">
        <a class="brand" href="{{ route('home.index') }}">SipPulseTestes</a>
        <a class="button button-secondary" href="{{ route('roles.index') }}">Cargos</a>
    </header>
    <main class="page">
        <h1 class="page-heading">{{ $role->exists ? 'Editar Cargo' : 'Novo Cargo' }}</h1>
        <section class="panel">
            @if ($errors->any())
                <div class="alert" role="alert">{{ $errors->first() }}</div>
            @endif
            <form action="{{ $role->exists ? route('roles.update', $role) : route('roles.store') }}" method="POST">
                @csrf
                @if ($role->exists) @method('PUT') @endif
                <div class="form-field">
                    <label for="name">Nome</label>
                    <input id="name" name="name" type="text" required maxlength="255" value="{{ old('name', $role->name) }}">
                </div>
                <div class="form-field">
                    <label for="description">Descrição</label>
                    <textarea id="description" name="description" rows="3">{{ old('description', $role->description) }}</textarea>
                </div>
                <fieldset style="border:0;padding:0;margin:1.25rem 0;">
                    <legend style="color:var(--navy);font-weight:700;margin-bottom:.5rem;">Permissões</legend>
                    @php($selectedPermissions = collect(old('permissions', $role->permissions->pluck('id')->all()))->all())
                    @foreach ($permissions as $permission)
                        <label style="display:flex;align-items:center;gap:.5rem;margin:.4rem 0;">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                @checked(in_array($permission->id, $selectedPermissions))
                                @disabled($role->name === 'super-adm')>
                            <span>{{ $permission->name }}{{ $permission->description ? ' - ' . $permission->description : '' }}</span>
                        </label>
                    @endforeach
                    @if ($role->name === 'super-adm')
                        <p class="form-note">O cargo super-adm mantém todas as permissões cadastradas.</p>
                    @endif
                </fieldset>
                <button class="button" type="submit">Salvar Cargo</button>
            </form>
        </section>
    </main>
@endsection