@extends('layouts.app')

@section('title', 'Adicionar DID | SipPulseTestes')

@section('content')
    <header class="topbar">
        <a class="brand" href="{{ route('home.index') }}">SipPulseTestes</a>
        <a class="button button-secondary" href="{{ route('home') }}">Painel SipPulse</a>
    </header>
    <main class="page">
        <h1 class="page-heading">Adicionar DID</h1>
        <section class="panel">
            <form action="{{ route('saveDid') }}" method='POST'>
                @csrf
                @method('POST')
            <label for="accountCode">accountCode: </label>
            <input type="text" id="accountCode" name="accountCode" required><br>

            <label for="aliasUsername">DID: </label>
            <input type="text" id="aliasUsername" name="aliasUsername" required><br>

            <label for="username">username: </label>
            <input type="text" id="username" name="username" required><br>

                <button class="button" type="submit">Cadastrar</button>

                <br><a class="back-link" href="{{ route('home') }}">Voltar</a>
            </form>
        </section>
    </main>
@endsection