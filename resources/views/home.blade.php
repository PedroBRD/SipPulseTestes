<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME PAGE</title>
</head>
<body>
    <h2>SipPulse</h2>
    <h3>Ativação de Novo Assinante</h3>
    <table>
        <tr>
            <th>Operação</th>
            <th>Acessos</th>
        </tr>
        <tr>
            <td>Criação de Tarifa de Vendas</td>
            <td><a href="{{ route('homeTvendas') }}">Acessar</a></td>
            <!-- Endpoints para Incluir, Listar e Excluir  -->
        </tr>
        <tr>
            <td>Criação de Plano de Tarifas</td>
            <td><a href="{{ route('homePtarifas') }}">Acessar</a></td>
            <!-- Endpoints para Incluir, Listar, Alterar e Remover  -->
        </tr>
        <tr>
            <td>Criação de Provedor</td>
            <td><a href="{{ route('provider') }}">Criar</a></td>
            <!-- Direcionamento externo com link do Pulse -->
        </tr>
        <tr>
            <td>Criação de Tarifa de Compra</td>
            <td><a href="">Criar</a></td>
            <!-- Direcionamento externo com link do Pulse  -->
        </tr>
        <tr>
            <td>Criação de Gateways</td>
            <td><a href="">Criar</a></td>
            <!-- Direcionamento externo com link do Pulse  -->
        </tr>
        <tr>
            <td>Criação de Lista de Gateways</td>
            <td><a href="">Criar</a></td>
            <!-- Direcionamento externo com link do Pulse  -->
        </tr>
        <tr>
            <td>Criação de Regras</td>
            <td><a href="">Criar</a></td>
            <!-- Direcionamento externo com link do Pulse  -->
        </tr>
        <tr>
            <td>Criação de Profile</td>
            <td><a href="{{ route('homeProfile') }}">Acessar</a></td>
            <!-- Direcionamento externo com link do Pulse para criar
            Existem endpoints apenas para Listar e Trocar  -->
        </tr>
        <tr>
            <td>Criação e Gerenciamento de Assinantes</td>
            <td><a href="{{ route('homeAssinantes') }}">Acessar</a></td>
            <!-- Existem endpoints para incluir, alterar, remover, trocar profile, listar DIDs, ativar e desativar, trocar senha, alteração de dados de serviço, alteração de dados de bilhetagem, ativar e desativar voicemail  -->
        </tr>
    </table>



    <h3>Funcionalidades</h3>
    <table>
        <tr>
            <th>Recursos</th>
            <th>Ações</th>
        </tr>
        <tr>
            <td>Listar Domínios</td>
            <td><a href="{{ route('listDomain') }}">Listar</a></td>
        </tr>
        <tr>
            <td>Listar DIDs Disponíveis</td>
            <td><a href="{{ route('findDids') }}">Listar</a></td>
        </tr>
        <tr>
            <td>Inclusão de DIDs</td>
            <td><a href="{{ route('addDid') }}">Novo</a></td>
        </tr>
        <tr>
            <td>Adicionar Créditos</td>
            <td><a href="{{ route('addCredit') }}">Adicionar</a></td>
        </tr>
    </table>
</body>
</html>