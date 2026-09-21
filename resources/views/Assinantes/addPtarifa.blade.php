<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Plano de Tarifas</title>
</head>
<body>
    <div>
        <form action="{{ route('savePtarifa') }}" method='PUT'>
            @csrf
            @method('POST')
            
            @include('Assinantes/_formPtarifa')

            <button type="submit">Criar</button><br>

            <a href="{{ route('homePtarifas') }}">Voltar</a>

        </form>
    </div>
</body>
</html>