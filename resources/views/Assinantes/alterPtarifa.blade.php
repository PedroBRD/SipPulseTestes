@extends('layouts.app')

@section('title', 'Alterar Plano de Tarifas | SipPulseTestes')

@section('content')
    <header class="topbar">
        <a class="brand" href="{{ route('home.index') }}">SipPulseTestes</a>
        <a class="button button-secondary" href="{{ route('homePtarifas') }}">Planos de Tarifas</a>
    </header>
    <main class="page">
        <h1 class="page-heading">Alterar Dados do Plano de Tarifas</h1>
        <section class="panel">
            <form action="{{ route('savePtarifa') }}" method='PUT'>
                @csrf
                @method('PUT')
                <div class="alert" role="status">Está apresentando erro até na endpoint, não vai alterar!</div>
                @include('Assinantes/_formPtarifa')
                <button class="button" type="submit">Alterar</button><br>
                <a class="back-link" href="{{ route('homePtarifas') }}">Voltar</a>
            </form>
        </section>
    </main>
@endsection