@extends('layouts.app')

@section('title', 'Editar Usuário | SipPulseTestes')

@section('content')
    <header class="topbar">
        <a class="brand" href="{{ route('home.index') }}">SipPulseTestes</a>
        <a class="button button-secondary" href="{{ route('users.index') }}">Usuários</a>
    </header>
    <main class="page">
        <h1 class="page-heading">Editar Usuário</h1>
        <section class="panel">
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                @include('Users/_formUsers')

                <a href="{{ route('users.roles.edit', $user) }}" class="button button-secondary">Gerenciar Cargo do Usuário</a><br>

                <button class="button" type="submit">Salvar Alterações</button>
            </form>
        </section>
        <a class="back-link" href="{{ route('users.index') }}">Voltar para usuários</a>
    </main>
@endsection