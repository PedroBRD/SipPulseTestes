<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar DIDs</title>
</head>
<body>
    <div>
    <form action="{{ route('saveDid') }}" method='POST'>
        @csrf
        @method('POST')
            <label for="accountCode">accountCode: </label>
            <input type="text" id="accountCode" name="accountCode" required><br>

            <label for="aliasUsername">DID: </label>
            <input type="text" id="aliasUsername" name="aliasUsername" required><br>

            <label for="username">username: </label>
            <input type="text" id="username" name="username" required><br>

            <button type="submit">Cadastrar</button>

            <br><a href="{{ route('home') }}">Voltar</a>
    </form>
    </div>
</body>
</html>