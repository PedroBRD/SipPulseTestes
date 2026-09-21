<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adição de Assinante</title>
</head>
<body>
    <div>
        <form action="{{ route('saveAssinante') }}" method='PUT'>
            @csrf 
            @method('POST')

            <label for="username">Nome do Assinante (Username): *</label>
            <input type="text" id="username" name="username" required><br>

            <label for="profile">Profile existente a ser vinculado: *</label>
            <input type="text" id="profile" name="profile" required><br>

            <label for="ratePlanId">Identificador do Plano de Tarifas do Assinante (ratePlanId): *</label>
            <input type="text" id="ratePlanId" name="ratePlanId" required><br>

            <label for="emailAddress">Endereço de Email: *</label>
            <input type="text" id="emailAddress" name="emailAddress" required><br>

            <label for="contractNumber">Número de Contrato: </label>
            <input type="text" id="contractNumber" name="contractNumber"><br>

            <label for="cityCode">Código da Cidade: </label>
            <input type="text" id="cityCode" name="cityCode"><br>

            <label for="firstName">Primeiro nome: </label>
            <input type="text" id="firstName" name="firstName"><br>

            <label for="lastName">Último nome: </label>
            <input type="text" id="lastName" name="lastName"><br>

            <label for="document">Documento: </label>
            <input type="text" id="document" name="document"><br>

            <label for="address">Endereço: </label>
            <input type="text" id="address" name="address"><br>

            <label for="number">Número: </label>
            <input type="text" id="number" name="number"><br>

            <label for="complement">Complemento: </label>
            <input type="text" name="complement" id="complement"><br>

            <label for="quarter">Bairro: </label>
            <input type="text" id="quarter" name="quarter"><br>

            <label for="city">Cidade: </label>
            <input type="text" id="city" name="city"><br>

            <label for="state">Estado: </label>
            <input type="text" id="state" name="state"><br>

            <label for="zip">CEP: </label>
            <input type="text" id="zip" name="zip"><br>

            <label for="phone">Telefone: </label>
            <input type="text" id="phone" name="phone"><br>

            <label for="countryCode">Código do País: *</label>
            <input type="text" id="countryCode" name="countryCode"><br>

            <label for="areaCode">Código de Área: *</label>
            <input type="text" id="areaCode" name="areaCode"><br>

            <label for="callLimit">Número de Chamadas Simultâneas: *</label>
            <input type="text" id="callLimit" name="callLimit"><br>

            <label for="voicemail">Usar Correio de voz? *</label>
            <input type="number" id="voicemail" name="voicemail" placeholder="1 para SIM, 0 para Não" min="0" max="1"><br>

            <label for="resellerId">Identificador de Revenda (resellerId): *</label>
            <input type="number" id="resellerId" name="resellerId" placeholder="Caso não tenha, use 0"><br>

            <label for="callsOnlyByIp">Ativar chamadas somente por IP? *</label>
            <input type="number" id="callsOnlyByIp" name="callsOnlyByIp" placeholder="1 para SIM, 0 para Não" min="0" max="1"><br>





            <button type="submit">Criar</button><br>

            <a href="{{ route('homeAssinantes') }}">Voltar</a>
        </form>
    </div>
</body>
</html>