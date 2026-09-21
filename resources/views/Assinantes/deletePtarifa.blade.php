<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar Plano de Tarifas</title>
</head>
<body>
    <div>
        <form action="{{ route('excludePtarifa') }}" method="POST">
            @csrf
            @method('DELETE')
            <label for="idRatePlan">Digite o Id do Plano de Tarifas que você deseja deletar: </label>
            <input type="text" id="idRatePlan" name="idRatePlan" required><br>

            <button type="submit">Deletar</button><br>
            <a href="{{ route('homeTvendas') }}">Voltar</a>
        </form>
    </div>
</body>
</html>