<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de DIDs</title>
</head>
<body>
    <div>
        <form action="{{ route('listDid') }}">
            @csrf
            @method('POST')
            <label for="accountCode">accountCode: </label>
            <input type="text" id="accountCode" name="accountCode" required><br>

            <button type="submit">Listar</button>
            <br><a href="{{ route('home') }}">Voltar</a>
        </form>
    </div>
</body>
</html>