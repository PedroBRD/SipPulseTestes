@extends('layouts.app')

@section('title', 'Detalhes do Cargo | SipPulseTestes')

@section('content')
    <header class="topbar">
        <a class="brand" href="{{ route('home.index') }}">SipPulseTestes</a>
        <a class="button button-secondary" href="{{ route('roles.index') }}">Cargos</a>
    </header>
    <main class="page">
        <h1 class="page-heading">{{ $role->name }}</h1>
        <section class="panel">
            <dl class="detail-list">
                <dt>Nome</dt><dd>{{ $role->name }}</dd>
                <dt>Descrição</dt><dd>{{ $role->description ?: '—' }}</dd>
                <dt>Permissões</dt>
                <dd>{{ $role->permissions->pluck('name')->sort()->join(', ') ?: 'Nenhuma permissão' }}</dd>
            </dl>
            <p><a class="button" href="{{ route('roles.edit', $role) }}">Editar Cargo</a></p>
        </section>
        <a class="back-link" href="{{ route('roles.index') }}">Voltar para cargos</a>
    </main>
@endsection