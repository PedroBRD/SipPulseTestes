@extends('layouts.app')

@section('title', 'Acesso ao Sistema | SipPulseTestes')

@section('content')
    <main class="login-shell">
        <section class="login-card" aria-labelledby="login-title">
            @if (session('error_message'))
                <div class="alert" role="alert">{{ session('error_message') }}</div>
            @endif

            <form action="{{ route('login.valida') }}" method="POST">
                @csrf
                @method('POST')

                <h1 id="login-title">SipPulseTestes</h1>

                <div class="form-field">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" autocomplete="username" required>
                </div>

                <div class="form-field">
                    <label for="password">Senha</label>
                    <input type="password" name="password" id="password" autocomplete="current-password" required>
                </div>

                <button class="button" type="submit">Entrar</button>
            </form>
        </section>
    </main>
@endsection