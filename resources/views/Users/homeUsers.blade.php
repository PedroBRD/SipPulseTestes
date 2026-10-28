@extends('layouts.app')

@section('title', 'Gerenciamento de Usuários | SipPulseTestes')

@section('content')
    <header class="topbar">
        <a class="brand" href="{{ route('home.index') }}">SipPulseTestes</a>
        <a class="button button-secondary" href="{{ route('home.index') }}">Início</a>
    </header>

    <main class="page">
        <h1 class="page-heading">Gerenciamento de Usuários</h1>
        <section class="panel" aria-label="Lista de usuários">
            <p style="margin: 0 0 1rem;">
                @can('create')
                <a href="{{ route('users.create') }}" class="button">Novo Usuário</a>
                @endcan

                @role('super-adm')
                <a href="{{ route('roles.index') }}" class="button button-secondary">Cargos e Permissões</a>
                @endrole
            </p>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <div class="table-actions">
                                        @can('view')
                                        <a class="text-link" href="{{ route('users.show', $user->id) }}">Visualizar</a>
                                        @endcan
                                        @can('edit')
                                        <a class="text-link" href="{{ route('users.edit', $user->id) }}">Editar</a>
                                        @endcan
                                        @can('delete')
                                        <form action="{{ route('users.delete', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="button button-secondary" type="submit">Excluir</button>
                                        </form>
                                        @endcan

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">Nenhum registro encontrado</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <a class="back-link" href="{{ route('home.index') }}">Voltar ao início</a>
    </main>
@endsection