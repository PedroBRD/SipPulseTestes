@extends('layouts.app')

@section('title', 'SipPulseTestes | Início')

@section('content')
    <header class="topbar">
        <a class="brand" href="{{ route('home.index') }}">SipPulseTestes</a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="button" type="submit">Sair</button>
        </form>
    </header>

    <main class="page">
        <h1 class="page-heading">Gerenciador</h1>
        <div class="dashboard-grid">
            <a class="dashboard-card" href="{{ route('users.index') }}">
                <div>
                    <h2>Gerenciador de Usuários</h2>
                    <p>Administre os usuários locais do sistema.</p>
                </div>
                <span class="card-link">Acessar usuários &rarr;</span>
            </a>
            <a class="dashboard-card" href="{{ route('home') }}">
                <div>
                    <h2>Integração SipPulse</h2>
                    <p>Acesse as operações e recursos de telefonia.</p>
                </div>
                <span class="card-link">Acessar integração &rarr;</span>
            </a>
        </div>
    </main>
@endsection