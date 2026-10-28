@extends('layouts.app')

@section('title', 'Permissões | SipPulseTestes')

@section('content')
    <header class="topbar">
        <a class="brand" href="{{ route('home.index') }}">SipPulseTestes</a>
        <a class="button button-secondary" href="{{ route('roles.index') }}">Cargos</a>
    </header>
    <main class="page">
        <h1 class="page-heading">Permissões</h1>
        @if (session('success'))
            <div class="alert" style="background:#edf8ef;color:#246b32;">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert" role="alert">{{ session('error') }}</div>
        @endif
        <p><a href="{{ route('permissions.create') }}" class="button">Nova Permissão</a></p>
        <section class="panel">
            <div class="table-wrap">
                <table>
                    <thead><tr><th>Nome</th><th>Descrição</th><th>Cargos associados</th><th>Ações</th></tr></thead>
                    <tbody>
                        @forelse ($permissions as $permission)
                            <tr>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->description ?: '—' }}</td>
                                <td>{{ $permission->roles->pluck('name')->sort()->join(', ') ?: '—' }}</td>
                                <td><div class="table-actions">
                                    <a class="text-link" href="{{ route('permissions.edit', $permission) }}">Editar</a>
                                    @if (! in_array($permission->name, ['view', 'create', 'edit', 'delete'], true))
                                        <form action="{{ route('permissions.destroy', $permission) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="button button-secondary" type="submit">Excluir</button>
                                        </form>
                                    @endif
                                </div></td>
                            </tr>
                        @empty
                            <tr><td colspan="4">Nenhuma permissão cadastrada.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </main>
@endsection