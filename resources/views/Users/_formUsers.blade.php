<div class="form-field">
    <label for="name">Nome</label>
    <input type="text" id="name" name="name" value="{{old('name', $user->name ?? '')}}">
</div>

<div class="form-field">
    <label for="email">E-mail</label>
    <input type="email" id="email" name="email" value="{{old('email', $user->email ?? '')}}">
</div>

<div class="form-field">
    <label for="password">Senha</label>
    <input type="password" id="password" name="password">
</div>