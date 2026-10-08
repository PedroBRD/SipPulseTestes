<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição de Usuários</title>
</head>
<body>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf 
        @method('PUT')
        
        @include('Users/_formUsers')

        <button type="submit">Salvar Alterações</button>
    </form>

    <a href="{{ route('users.index') }}">Voltar</a>
    
</body>
</html>