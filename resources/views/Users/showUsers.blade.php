<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Usuários</title>
</head>
<body>
    <h2>Informações do Usuário</h2><br><br>
    <h3>ID - {{$user->id}}</h3>
    <h3>Nome - {{$user->name}}</h3>
    <h3>Email - {{$user->email}}</h3>
    <h3>Criado em - {{$user->created_at?->format("d-m-Y H:i:s") ?? 'Não cadastrado'}}</h3><br><br>

    <a href="{{ route('users.index') }}">Voltar</a>

</body>
</html>