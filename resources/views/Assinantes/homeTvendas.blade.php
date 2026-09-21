<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador Tarifa de Vendas</title>
</head>
<body>
    <h3>Incluir Tarifa de Vendas</h3>
    <a href="{{ route('addTvenda') }}">Incluir</a><br><br>


    <h3>Listar Tarifa de Vendas</h3>
    <a href="{{ route('listTvenda') }}">Listar</a><br><br>


    <h3>Excluir Tarifa de Vendas</h3>
    <a href="{{ route('deleteTvenda') }}">Excluir</a><br><br><br>


    <br><a href="{{ route('home') }}">Voltar</a>
</body>
</html>