<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incluir Tarifa de Vendas</title>
</head>
<body>
    <h2>Inclusão de Tarifa de Vendas</h2>
    <div>
        <form action="{{ route('saveTvendas') }}" method='POST'>
            @csrf 
            @method('POST')
            <label for="name">Nome da Tarifa: </label>
            <input type="text" id="name" name="name" Required><br>

            <label for="cadency">Taxa de cadência: </label>
            <input type="text" id="cadency" name="cadency" required><br>

            <label for="prefix">Prefixo: </label>
            <input type="text" id="prefix" name="prefix" required><br>
            
            <label for="rateId">ID da Tarifa (RateID): </label>
            <input type="text" id="rateId" name="rateId" required><br>

            <label for="rateValue">Valor da Tarifa: </label>
            <input type="text" id="rateValue" name="rateValue" required><br>

            <label for="serviceType">Tipo de Serviço (LDN, LOCAL, LDI, ESPECIAL...): </label>
            <input type="text" id="serviceType" name="serviceType" required><br>

            <label for="txConnection">Taxa de Conexão: </label>
            <input type="text" name="txConnection" id="txConnection" required><br>

            <label for="txDelay">Taxa de delay: </label>
            <input type="text" name="txDelay" id="txDelay"><br>

            <label for="txDiscard">Taxa de Descarte: </label>
            <input type="text" name="txDiscard" id="txDiscard"><br>

            <button type="submit">Cadastrar</button><br>

            <a href="{{ route('homeTvendas') }}">Voltar</a>

        </form>
    </div>
</body>
</html>