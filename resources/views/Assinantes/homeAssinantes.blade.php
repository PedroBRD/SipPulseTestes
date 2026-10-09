@extends('layouts.app')

@section('title', 'Assinantes | SipPulseTestes')

@section('content')
    <header class="topbar">
        <a class="brand" href="{{ route('home.index') }}">SipPulseTestes</a>
        <a class="button button-secondary" href="{{ route('home') }}">Painel SipPulse</a>
    </header>
    <main class="page">
        <h1 class="page-heading">Gerenciamento de Assinantes</h1>
        <section class="action-list">
            <article class="action-card"><h2>Criar assinante</h2><a class="button" href="{{ route('addAssinante') }}">Criar</a></article>
            <article class="action-card"><h2>Remover assinante</h2><a class="button" href="{{ route('deleteAssinante') }}">Remover</a></article>
            <article class="action-card"><h2>Alterar senha</h2><a class="button" href="{{ route('changePass') }}">Alterar</a></article>
        </section>
        <a class="back-link" href="{{ route('home') }}">Voltar ao painel SipPulse</a>
    </main>
@endsection