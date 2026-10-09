@extends('layouts.app')

@section('title', 'Remover Assinante | SipPulseTestes')

@section('content')
    <header class="topbar">
        <a class="brand" href="{{ route('home.index') }}">SipPulseTestes</a>
        <a class="button button-secondary" href="{{ route('homeAssinantes') }}">Assinantes</a>
    </header>
    <main class="page">
        <h1 class="page-heading">Remover Assinante</h1>
        <section class="panel">
            <form action="{{ route('excludeAssinante') }}" method="POST">
                @csrf
                @method('DELETE')
            <label for="username">Digite o Username do Assinante que você deseja deletar: </label>
            <input type="text" id="username" name="username" required><br>

                <button class="button" type="submit">Remover</button><br>
                <a class="back-link" href="{{ route('homeAssinantes') }}">Voltar</a>
            </form>
        </section>
    </main>
@endsection