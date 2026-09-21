<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Dados do Plano de Tarifas</title>
</head>
<body>
    <div>
        <form action="{{ route('savePtarifa') }}" method='PUT'>
            @csrf 
            @method('PUT')

            <h2>Está apresentando erro até na Endpoint, não vai alterar!</h2><br><br><br>

            @include('Assinantes/_formPtarifa')

            <button type="submit">Alterar</button><br>

            <a href="{{ route('homePtarifas') }}">Voltar</a>
        </form>
    </div>
</body>
</html>