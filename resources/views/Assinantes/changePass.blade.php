<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Senha</title>
</head>
<body>
    <h2>Alterar senha do Assinante</h2>
    <div>
        <form action="{{ route('savePass') }}" method="PUT">
            @csrf
            @method('PUT')

            <label for="username">De qual usuário vai alterar a senha? </label>
            <input type="text" id="username" name="username" required><br>

            <label for="actualPassword">Senha Atual: </label>
            <input type="password" id="actualPassword" name="actualPassword" required><br>

            <label for="newPassword">Nova Senha: </label>
            <input type="password" id="newPassword" name="newPassword" required><br>

            <label for="confirmNewPassword">Confirme a Nova Senha: </label>
            <input type="password" id="confirmNewPassword" name="confirmNewPassword" required><br>
            
            <button type="submit">Alterar Senha</button><br><br>

            <a href="{{ route('homeAssinantes') }}">Voltar</a>


        </form>
    </div>
</body>
</html>