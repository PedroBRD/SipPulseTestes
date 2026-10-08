<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar novos usuários</title>
</head>
<body>
    <form action="{{ route('users.store') }}" method="POST">
        <!-- <h3>dentro da create user</h3> -->
        @csrf
        @include('Users/_formUsers')

        <button type="submit">Cadastrar</button>
    </form><br>

    <a href="{{ route('users.index') }}">Voltar</a>
</body>
</html>