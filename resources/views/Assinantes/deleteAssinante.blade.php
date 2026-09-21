<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar um Assinante</title>
</head>
<body>
    <div>
        <form action="{{ route('excludeAssinante') }}" method="POST">
            @csrf
            @method('DELETE')
            <label for="username">Digite o Username do Assinante que você deseja deletar: </label>
            <input type="text" id="username" name="username" required><br>

            <button type="submit">Deletar</button><br>
            <a href="{{ route('homeAssinantes') }}">Voltar</a>
        </form>
    </div>
</body>
</html>