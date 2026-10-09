@extends('layouts.app')

@section('title', 'Listagem de DIDs | SipPulseTestes')

@section('content')
    <header class="topbar">
        <a class="brand" href="{{ route('home.index') }}">SipPulseTestes</a>
        <a class="button button-secondary" href="{{ route('home') }}">Painel SipPulse</a>
    </header>
    <main class="page">
        <h1 class="page-heading">Listagem de DIDs</h1>
        <section class="panel">
            <form action="{{ route('listDid') }}">
                @csrf
                @method('POST')
            <label for="accountCode">accountCode: </label>
            <input type="text" id="accountCode" name="accountCode" required><br>

                <button class="button" type="submit">Listar</button>
                <br><a class="back-link" href="{{ route('home') }}">Voltar</a>
            </form>
        </section>
    </main>
@endsection