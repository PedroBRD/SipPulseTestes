<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador Plano de Tarifas</title>
</head>
<body>
    <h3>Incluir Plano de Tarifas</h3>
    <a href="{{ route('addPtarifa') }}">Incluir</a>


    <h3>Listar Plano de Tarifas</h3>
    <a href="{{ route('listPtarifa') }}">Listar</a>


    <h3>Alterar Plano de Tarifas</h3>
    <a href="{{ route('alterPtarifa') }}">Alterar</a>


    <h3>Deletar Plano de Tarifas</h3>
    <a href="{{ route('deletePtarifa') }}">Deletar</a>

    
    <br><br><br><a href="{{ route('home') }}">Voltar</a>
</body>
</html>