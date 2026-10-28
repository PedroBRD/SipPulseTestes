@extends('layouts.app')

@section('title', ($permission->exists ? 'Editar Permissão' : 'Nova Permissão') . ' | SipPulseTestes')

@section('content')
    <header class="topbar">
        <a class="brand" href="{{ route('home.index') }}">SipPulseTestes</a>
        <a class="button button-secondary" href="{{ route('permissions.index') }}">Permissões</a>
    </header>
    <main class="page">
        <h1 class="page-heading">{{ $permission->exists ? 'Editar Permissão' : 'Nova Permissão' }}</h1>
        <section class="panel">
            @if ($errors->any())
                <div class="alert" role="alert">{{ $errors->first() }}</div>
            @endif
            <form action="{{ $permission->exists ? route('permissions.update', $permission) : route('permissions.store') }}" method="POST">
                @csrf
                @if ($permission->exists) @method('PUT') @endif
                <div class="form-field">
                    <label for="name">Nome</label>
                    <input id="name" name="name" type="text" required maxlength="255" value="{{ old('name', $permission->name) }}">
                </div>
                <div class="form-field">
                    <label for="description">Descrição</label>
                    <textarea id="description" name="description" rows="3">{{ old('description', $permission->description) }}</textarea>
                </div>
                <button class="button" type="submit">Salvar Permissão</button>
            </form>
        </section>
    </main>
@endsection