<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
</head>
<body>
    <h2>Gerenciador</h2>
    <ul>
        <li>Usuários <br>
            <a href="{{ route('users.index') }}">Gerenciar</a>
        </li><br><br>
        <li>SipPulse <br>
            <a href="{{ route('home') }}">Acessar</a>
        </li>
    </ul>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>