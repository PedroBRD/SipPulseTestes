@extends('layouts.app')

@section('title', 'Painel SipPulse | SipPulseTestes')

@section('content')
    <header class="topbar">
        <a class="brand" href="{{ route('home.index') }}">SipPulseTestes</a>
        <a class="button button-secondary" href="{{ route('home.index') }}">Início</a>
    </header>

    <main class="page">
        <h1 class="page-heading">Painel SipPulse</h1>
        <section class="panel">
            <h2 class="section-title">Ativação de Novo Assinante</h2>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr><th scope="col">Operação</th><th scope="col">Acessos</th></tr>
                    </thead>
                    <tbody>
                        <tr><td>Criação de Tarifa de Vendas</td><td><a class="text-link" href="{{ route('homeTvendas') }}">Acessar</a></td></tr>
                        <tr><td>Criação de Plano de Tarifas</td><td><a class="text-link" href="{{ route('homePtarifas') }}">Acessar</a></td></tr>
                        <tr><td>Criação de Provedor</td><td><a class="text-link" href="{{ route('provider') }}">Criar</a></td></tr>
                        <tr><td>Criação de Tarifa de Compra</td><td><a class="text-link" href="">Criar</a></td></tr>
                        <tr><td>Criação de Gateways</td><td><a class="text-link" href="">Criar</a></td></tr>
                        <tr><td>Criação de Lista de Gateways</td><td><a class="text-link" href="">Criar</a></td></tr>
                        <tr><td>Criação de Regras</td><td><a class="text-link" href="">Criar</a></td></tr>
                        <tr><td>Criação de Profile</td><td><a class="text-link" href="{{ route('homeProfile') }}">Acessar</a></td></tr>
                        <tr><td>Criação e Gerenciamento de Assinantes</td><td><a class="text-link" href="{{ route('homeAssinantes') }}">Acessar</a></td></tr>
                    </tbody>
                </table>
            </div>

            <h2 class="section-title">Funcionalidades</h2>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr><th scope="col">Recursos</th><th scope="col">Ações</th></tr>
                    </thead>
                    <tbody>
                        <tr><td>Listar Domínios</td><td><a class="text-link" href="{{ route('listDomain') }}">Listar</a></td></tr>
                        <tr><td>Listar DIDs Disponíveis</td><td><a class="text-link" href="{{ route('findDids') }}">Listar</a></td></tr>
                        <tr><td>Inclusão de DIDs</td><td><a class="text-link" href="{{ route('addDid') }}">Novo</a></td></tr>
                        <tr><td>Adicionar Créditos</td><td><a class="text-link" href="{{ route('addCredit') }}">Adicionar</a></td></tr>
                    </tbody>
                </table>
            </div>
        </section>

        <a class="back-link" href="{{ route('home.index') }}">Voltar ao início</a>
    </main>
@endsection