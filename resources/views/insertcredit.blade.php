@extends('layouts.app')

@section('title', 'Adicionar Créditos | SipPulseTestes')

@section('content')
    <header class="topbar">
        <a class="brand" href="{{ route('home.index') }}">SipPulseTestes</a>
        <a class="button button-secondary" href="{{ route('home') }}">Painel SipPulse</a>
    </header>
    <main class="page">
        <h1 class="page-heading">Adicionar Créditos</h1>
        <section class="panel">
            <form action="{{ route('insertCredit') }}" method='POST'>
                @csrf
                @method('POST')

            <label for="username">Username: </label>
            <input type="text" id="username" name="username" required><br>

            <label for="value">Valor a ser adicionado: </label>
            <input type="text" id="value" name="value" required><br>

            <label for="obs">Observação/Descrição: </label>
            <input type="text" id="obs" name="obs" required><br>

                <button class="button" type="submit">Adicionar</button>

                <br><a class="back-link" href="{{ route('home') }}">Voltar</a>
            </form>
        </section>
    </main>
@endsection