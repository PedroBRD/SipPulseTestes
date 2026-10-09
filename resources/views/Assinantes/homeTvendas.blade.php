@extends('layouts.app')

@section('title', 'Tarifas de Vendas | SipPulseTestes')

@section('content')
    <header class="topbar">
        <a class="brand" href="{{ route('home.index') }}">SipPulseTestes</a>
        <a class="button button-secondary" href="{{ route('home') }}">Painel SipPulse</a>
    </header>
    <main class="page">
        <h1 class="page-heading">Tarifas de Vendas</h1>
        <section class="action-list">
            <article class="action-card"><h2>Incluir tarifa</h2><a class="button" href="{{ route('addTvenda') }}">Incluir</a></article>
            <article class="action-card"><h2>Listar tarifas</h2><a class="button" href="{{ route('listTvenda') }}">Listar</a></article>
            <article class="action-card"><h2>Excluir tarifa</h2><a class="button" href="{{ route('deleteTvenda') }}">Excluir</a></article>
        </section>
        <a class="back-link" href="{{ route('home') }}">Voltar ao painel SipPulse</a>
    </main>
@endsection