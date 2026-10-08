<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Assinantes</title>
</head>
<body>
    <h3>Criar Assinante</h3>
    <a href="{{ route('addAssinante') }}">Criar</a><br>

    <h3>Remover Assinantes</h3>
    <a href="{{ route('deleteAssinante') }}">Remover</a><br>
    
    <h3>Alterar Senha de um Assinante</h3>
    <a href="{{ route('changePass') }}">Alterar</a><br><br>

    <a href="{{ route('home') }}">Voltar</a>
</body>
</html>