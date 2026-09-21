<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Créditos</title>
</head>
<body>
    <div>
        <form action="{{ route('insertCredit') }}" method='POST'>
            @csrf
            @method('POST')

            <label for="username">Username: </label>
            <input type="text" id="username" name="username" required><br>

            <label for="value">Valor a ser adicionado: </label>
            <input type="text" id="value" name="value" required><br>

            <label for="obs">Observação/Descrição: </label>
            <input type="text" id="obs" name="obs" required><br>

            <button type="submit">Adicionar</button>

            <br><a href="{{ route('home') }}">Voltar</a>
        </form>
    </div>
</body>
</html>