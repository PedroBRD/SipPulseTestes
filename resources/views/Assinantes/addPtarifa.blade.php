@extends('layouts.app')

@section('title', 'Adicionar Plano de Tarifas | SipPulseTestes')

@section('content')
    <header class="topbar">
        <a class="brand" href="{{ route('home.index') }}">SipPulseTestes</a>
        <a class="button button-secondary" href="{{ route('homePtarifas') }}">Planos de Tarifas</a>
    </header>
    <main class="page">
        <h1 class="page-heading">Adicionar Plano de Tarifas</h1>
        <section class="panel">
            <form action="{{ route('savePtarifa') }}" method='PUT'>
                @csrf
                @method('POST')
                @include('Assinantes/_formPtarifa')
                <button class="button" type="submit">Criar</button><br>
                <a class="back-link" href="{{ route('homePtarifas') }}">Voltar</a>
            </form>
        </section>
    </main>
@endsection