<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div>
        @if (session('error_message'))
            <div>{{session('error_mesage')}}</div>
        @endif

        <form action="{{ route('login.valida') }}" method="POST">
            @csrf
            @method('POST')

            <h2>Login</h2>

            <label for="email">Usuário: </label>
            <input type="text" name="email" id="email"><br><br>

            <label for="password">Senha: </label>
            <input type="password" name="password" id="password"><br><br>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>