@extends('layouts.app')

@section('title', 'Excluir Plano de Tarifas | SipPulseTestes')

@section('content')
    <header class="topbar">
        <a class="brand" href="{{ route('home.index') }}">SipPulseTestes</a>
        <a class="button button-secondary" href="{{ route('homePtarifas') }}">Planos de Tarifas</a>
    </header>
    <main class="page">
        <h1 class="page-heading">Excluir Plano de Tarifas</h1>
        <section class="panel">
            <form action="{{ route('excludePtarifa') }}" method="POST">
                @csrf
                @method('DELETE')
            <label for="idRatePlan">Digite o Id do Plano de Tarifas que você deseja deletar: </label>
            <input type="text" id="idRatePlan" name="idRatePlan" required><br>

                <button class="button" type="submit">Excluir</button><br>
                <a class="back-link" href="{{ route('homeTvendas') }}">Voltar</a>
            </form>
        </section>
    </main>
@endsection