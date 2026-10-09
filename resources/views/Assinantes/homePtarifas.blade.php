@extends('layouts.app')

@section('title', 'Planos de Tarifas | SipPulseTestes')

@section('content')
    <header class="topbar">
        <a class="brand" href="{{ route('home.index') }}">SipPulseTestes</a>
        <a class="button button-secondary" href="{{ route('home') }}">Painel SipPulse</a>
    </header>
    <main class="page">
        <h1 class="page-heading">Planos de Tarifas</h1>
        <section class="action-list">
            <article class="action-card"><h2>Incluir plano</h2><a class="button" href="{{ route('addPtarifa') }}">Incluir</a></article>
            <article class="action-card"><h2>Listar planos</h2><a class="button" href="{{ route('listPtarifa') }}">Listar</a></article>
            <article class="action-card"><h2>Alterar plano</h2><a class="button" href="{{ route('alterPtarifa') }}">Alterar</a></article>
            <article class="action-card"><h2>Excluir plano</h2><a class="button" href="{{ route('deletePtarifa') }}">Excluir</a></article>
        </section>
        <a class="back-link" href="{{ route('home') }}">Voltar ao painel SipPulse</a>
    </main>
@endsection