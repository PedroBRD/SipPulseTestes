@extends('layouts.app')

@section('title', 'Visualizar Usuário | SipPulseTestes')

@section('content')
    <header class="topbar">
        <a class="brand" href="{{ route('home.index') }}">SipPulseTestes</a>
        <a class="button button-secondary" href="{{ route('users.index') }}">Usuários</a>
    </header>
    <main class="page">
        <h1 class="page-heading">Informações do Usuário</h1>
        <section class="panel">
            <dl class="detail-list">
                <dt>ID</dt><dd>{{ $user->id }}</dd>
                <dt>Nome</dt><dd>{{ $user->name }}</dd>
                <dt>E-mail</dt><dd>{{ $user->email }}</dd>
                <dt>Criado em</dt><dd>{{ $user->created_at?->format('d-m-Y H:i:s') ?? 'Não cadastrado' }}</dd>
            </dl>
        </section>
        <a class="back-link" href="{{ route('users.index') }}">Voltar para usuários</a>
    </main>
@endsection