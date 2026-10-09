@extends('layouts.app')

@section('title', 'Novo Usuário | SipPulseTestes')

@section('content')
    <header class="topbar">
        <a class="brand" href="{{ route('home.index') }}">SipPulseTestes</a>
        <a class="button button-secondary" href="{{ route('users.index') }}">Usuários</a>
    </header>
    <main class="page">
        <h1 class="page-heading">Novo Usuário</h1>
        <section class="panel">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                @include('Users/_formUsers')
                <button class="button" type="submit">Cadastrar</button>
            </form>
        </section>
        <a class="back-link" href="{{ route('users.index') }}">Voltar para usuários</a>
    </main>
@endsection