@extends('layouts.app')

@section('title', 'Alterar Senha | SipPulseTestes')

@section('content')
    <header class="topbar">
        <a class="brand" href="{{ route('home.index') }}">SipPulseTestes</a>
        <a class="button button-secondary" href="{{ route('homeAssinantes') }}">Assinantes</a>
    </header>
    <main class="page">
        <h1 class="page-heading">Alterar senha do Assinante</h1>
        <section class="panel">
            <form action="{{ route('savePass') }}" method="PUT">
                @csrf
                @method('PUT')

            <label for="username">De qual usuário vai alterar a senha? </label>
            <input type="text" id="username" name="username" required><br>

            <label for="actualPassword">Senha Atual: </label>
            <input type="password" id="actualPassword" name="actualPassword" required><br>

            <label for="newPassword">Nova Senha: </label>
            <input type="password" id="newPassword" name="newPassword" required><br>

            <label for="confirmNewPassword">Confirme a Nova Senha: </label>
            <input type="password" id="confirmNewPassword" name="confirmNewPassword" required><br>
            
                <button class="button" type="submit">Alterar Senha</button><br><br>

                <a class="back-link" href="{{ route('homeAssinantes') }}">Voltar</a>


            </form>
        </section>
    </main>
@endsection