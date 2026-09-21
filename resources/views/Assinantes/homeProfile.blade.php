<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Profiles</title>
</head>
<body>
    <h3>Criar Profile</h3>
    <a href="">criar</a><br>

    <h3>Listar Profiles por Domínio</h3>
    <a href="{{ route('listProfile') }}">Listar</a><br>

    <h3>Trocar Profile do Assinante</h3>
    <a href="{{ route('changeProfile') }}">Trocar</a><br>

    <br><a href="{{ route('home') }}">Voltar</a>
</body>
</html>