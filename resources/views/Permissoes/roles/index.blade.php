@extends('layouts.app')

@section('title', 'Cargos | SipPulseTestes')

@section('content')
    <header class="topbar">
        <a class="brand" href="{{ route('home.index') }}">SipPulseTestes</a>
        <a class="button button-secondary" href="{{ route('users.index') }}">Usuários</a>
    </header>
    <main class="page">
        <h1 class="page-heading">Cargos e Permissões</h1>
        @if (session('success'))
            <div class="alert" style="background:#edf8ef;color:#246b32;">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert" role="alert">{{ session('error') }}</div>
        @endif
        <p><a href="{{ route('roles.create') }}" class="button">Novo Cargo</a>
            <a href="{{ route('permissions.index') }}" class="button button-secondary">Permissões</a></p>
        <section class="panel">
            <h2 class="section-title">Cargos cadastrados</h2>
            <div class="table-wrap">
                <table>
                    <thead><tr><th>Nome</th><th>Descrição</th><th>Permissões</th><th>Ações</th></tr></thead>
                    <tbody>
                        @forelse ($roles as $role)
                            <tr>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->description ?: '—' }}</td>
                                <td>{{ $role->permissions->pluck('name')->sort()->join(', ') ?: '—' }}</td>
                                <td><div class="table-actions">
                                    <a class="text-link" href="{{ route('roles.show', $role) }}">Visualizar</a>
                                    <a class="text-link" href="{{ route('roles.edit', $role) }}">Editar</a>
                                    @if ($role->name !== 'super-adm')
                                        <form action="{{ route('roles.destroy', $role) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="button button-secondary" type="submit">Excluir</button>
                                        </form>
                                    @endif
                                </div></td>
                            </tr>
                        @empty
                            <tr><td colspan="4">Nenhum cargo cadastrado.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
        <a class="back-link" href="{{ route('users.index') }}">Voltar para usuários</a>
    </main>
@endsection