@extends('layouts.app')

@section('title', 'Excluir Tarifa de Venda | SipPulseTestes')

@section('content')
    <header class="topbar">
        <a class="brand" href="{{ route('home.index') }}">SipPulseTestes</a>
        <a class="button button-secondary" href="{{ route('homeTvendas') }}">Tarifas de Vendas</a>
    </header>
    <main class="page">
        <h1 class="page-heading">Excluir Tarifa de Venda</h1>
        <section class="panel">
            <form action="{{ route('excludeTvenda') }}" method="POST">
                @csrf
                @method('DELETE')
            <label for="rateId">Digite o RateId da Tarifa que você deseja deletar: </label>
            <input type="text" id="rateId" name="rateId" required><br>

                <button class="button" type="submit">Excluir</button><br>
                <a class="back-link" href="{{ route('homeTvendas') }}">Voltar</a>
            </form>
        </section>
    </main>
@endsection