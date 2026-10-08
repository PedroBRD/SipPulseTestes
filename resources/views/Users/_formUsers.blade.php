<div>
    <label for="name">Nome: </label>
    <input type="text" id="name" name="name" value="{{old('name', $user->name ?? '')}}"><br><br>
</div>

<div>
    <label for="email">E-mail: </label>
    <input type="text" id="email" name="email" value="{{old('email', $user->email ?? '')}}"><br><br>
</div>

<div>
    <label for="password">Senha: </label>
    <input type="password" id="password" name="password"><br><br>
</div>