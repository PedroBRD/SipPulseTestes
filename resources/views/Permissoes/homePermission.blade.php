@extends('layouts.app')

@section('title', 'Atribuir Cargo | SipPulseTestes')

@section('content')
    <header class="topbar">
        <a class="brand" href="{{ route('home.index') }}">SipPulseTestes</a>
        <a class="button button-secondary" href="{{ route('roles.index') }}">Cargos e Permissões</a>
    </header>
    <main class="page">
        <h1 class="page-heading">Cargo do Usuário</h1>
        <section class="panel">
            @if (session('success'))
                <div class="alert" style="background:#edf8ef;color:#246b32;">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert" role="alert">{{ $errors->first() }}</div>
            @endif

            <dl class="detail-list">
                <dt>Nome</dt><dd>{{ $user->name }}</dd>
                <dt>E-mail</dt><dd>{{ $user->email }}</dd>
                <dt>Cargo atual</dt><dd>{{ $roleAtual?->name ?? 'Nenhum cargo atribuído' }}</dd>
            </dl>

            <form action="{{ route('users.roles.update', $user) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-field" style="margin-top:1rem;">
                    <label for="role_id">Novo cargo</label>
                    <select id="role_id" name="role_id" required>
                        <option value="">Selecione um cargo</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" @selected((string) old('role_id', $roleAtual?->id) === (string) $role->id)>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button class="button" type="submit">Salvar Cargo</button>
            </form>
        </section>
        <a class="back-link" href="{{ route('users.edit', $user) }}">Voltar para edição do usuário</a>
    </main>
@endsection