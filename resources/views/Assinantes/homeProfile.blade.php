@extends('layouts.app')

@section('title', 'Profiles | SipPulseTestes')

@section('content')
    <header class="topbar">
        <a class="brand" href="{{ route('home.index') }}">SipPulseTestes</a>
        <a class="button button-secondary" href="{{ route('home') }}">Painel SipPulse</a>
    </header>
    <main class="page">
        <h1 class="page-heading">Profiles</h1>
        <section class="action-list">
            <article class="action-card"><h2>Criar profile</h2><a class="button" href="">Criar</a></article>
            <article class="action-card"><h2>Listar por domínio</h2><a class="button" href="{{ route('listProfile') }}">Listar</a></article>
            <article class="action-card"><h2>Trocar profile do assinante</h2><a class="button" href="{{ route('changeProfile') }}">Trocar</a></article>
        </section>
        <a class="back-link" href="{{ route('home') }}">Voltar ao painel SipPulse</a>
    </main>
@endsection