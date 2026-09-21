<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar Tarifa de Venda</title>
</head>
<body>
    <div>
        <form action="{{ route('excludeTvenda') }}" method="POST">
            @csrf
            @method('DELETE')
            <label for="rateId">Digite o RateId da Tarifa que você deseja deletar: </label>
            <input type="text" id="rateId" name="rateId" required><br>

            <button type="submit">Deletar</button><br>
            <a href="{{ route('homeTvendas') }}">Voltar</a>
        </form>
    </div>
</body>
</html>