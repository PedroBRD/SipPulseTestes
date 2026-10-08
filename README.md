# SipPulseTestes

Aplicacao Laravel 10 com PHP e MySQL. O ambiente de desenvolvimento usa Docker para que PHP, Apache, Composer e MySQL sejam executados em containers.

## 1. O que e Docker?

Docker executa processos isolados chamados containers. Um container e criado a partir de uma imagem, que e um pacote com o sistema e as dependencias necessarias.

Neste projeto:

- `app` e o container da aplicacao: PHP 8.2 + Apache + codigo Laravel.
- `db` e o container do banco: MySQL 8.
- `docker-compose.yml` descreve como esses containers devem ser criados e conectados.
- `Dockerfile` ensina como construir a imagem da aplicacao.
- `volume` guarda dados que precisam sobreviver a parada ou recriacao dos containers.

Docker Compose e o comando usado para operar varios containers juntos. O comando correto e `docker compose`, nao `composer up`. Composer e outra ferramenta: ele instala dependencias PHP do Laravel.

## 2. Pre-requisitos

Instale o Docker Engine e o plugin Docker Compose. Confira:

```bash
docker --version
docker compose version
```

No Linux, talvez seu usuario precise estar no grupo `docker` para executar comandos sem `sudo`.

## 3. Primeira execucao do projeto

A primeira execucao cria as imagens, os containers e o banco. Na raiz do projeto:

```bash
cp .env.example .env
docker compose up -d --build
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate
```

Depois, abra http://localhost:8000.

O `--build` e necessario quando a imagem ainda nao existe ou quando o `Dockerfile` mudou. A opcao `-d` significa executar em segundo plano, liberando o terminal.

## 4. Rotina diaria

### Comecar o trabalho

Abra um terminal na pasta do projeto e execute:

```bash
docker compose start
```

Se os containers ainda nao existirem, use:

```bash
docker compose up -d
```

Confira o estado:

```bash
docker compose ps
```

Acesse http://localhost:8000.

### Durante o desenvolvimento

O codigo da pasta local esta montado no container. Portanto, alteracoes em PHP, Blade, rotas e migrations aparecem sem reconstruir a imagem.

Comandos Laravel sao executados dentro do container da aplicacao:

```bash
docker compose exec app php artisan route:list
docker compose exec app php artisan migrate
docker compose exec app php artisan migrate:status
docker compose exec app php artisan test
```

Para instalar ou atualizar uma dependencia PHP:

```bash
docker compose exec app composer require nome/do-pacote
docker compose exec app composer update
```

Depois de alterar `composer.json` ou o `Dockerfile`, reconstrua a imagem:

```bash
docker compose up -d --build
```

Para acompanhar problemas:

```bash
docker compose logs -f app
docker compose logs -f db
```

Pressione `Ctrl+C` para sair da visualizacao dos logs. Isso nao para os containers.

### Encerrar o trabalho

Antes de fechar o computador, voce pode parar os containers:

```bash
docker compose stop
```

No dia seguinte, `docker compose start` inicia os mesmos containers novamente. O banco continua preservado.

Outra opcao e remover os containers, mantendo os volumes e os dados:

```bash
docker compose down
```

No proximo inicio, o Compose criara containers novos usando os mesmos dados do banco.

## 5. Comandos Docker essenciais

| Comando | Funcao |
| --- | --- |
| `docker compose up -d` | Cria, inicia e conecta os servicos |
| `docker compose up -d --build` | Reconstrói a imagem e inicia os servicos |
| `docker compose start` | Inicia containers ja existentes |
| `docker compose stop` | Para containers sem remove-los |
| `docker compose down` | Para e remove containers e rede, preservando volumes |
| `docker compose ps` | Mostra o estado dos servicos |
| `docker compose logs -f app` | Mostra logs da aplicacao em tempo real |
| `docker compose exec app comando` | Executa um comando dentro do container `app` |
| `docker compose config` | Valida a configuracao do Compose |

## 6. Containers, imagens e volumes

O container e temporario. Ele pode ser removido e recriado sem problema. O volume e usado para dados persistentes:

- `mysql_data`: dados do MySQL.
- `vendor`: dependencias instaladas pelo Composer.
- `storage`: logs e arquivos gerados pelo Laravel.
- `framework_cache`: cache gravavel do Laravel.

Para listar volumes:

```bash
docker volume ls
```

Para apagar containers e tambem o banco local:

```bash
docker compose down -v
```

Use `down -v` somente quando quiser recriar o banco do zero. Essa operacao e destrutiva.

## 7. Banco de dados

De dentro do Docker, o Laravel acessa o MySQL pelo hostname `db`, que e o nome do servico no Compose. Nao use `127.0.0.1` para a conexao entre containers.

Para conectar ao MySQL:

```bash
docker compose exec db mysql -u sippSELECT user, host FROM mysql.user;
Na sua maquina, o MySQL tambem esta exposto em `localhost:3306`.

## 8. Como iniciar um projeto novo com Docker?

O fluxo comum e:

1. Criar o projeto e definir as dependencias da aplicacao.
2. Criar um `Dockerfile` com o runtime, neste caso PHP e Apache.
3. Criar um `docker-compose.yml` para a aplicacao e servicos auxiliares, como banco e Redis.
4. Criar um `.dockerignore` para nao enviar arquivos locais desnecessarios ao build.
5. Subir o ambiente com `docker compose up -d --build`.
6. Executar comandos de inicializacao dentro do container com `docker compose exec`.
7. Desenvolver usando o codigo montado por volume.
8. Parar com `docker compose stop` ou remover os containers com `docker compose down`.

É comum usar Docker desde o inicio de um projeto. Isso ajuda a manter a mesma versao de PHP, extensoes e banco para todas as pessoas da equipe. Nao e obrigatorio: voce tambem pode desenvolver com PHP, Composer e MySQL instalados diretamente na maquina. A vantagem do Docker e tornar esse ambiente reproduzivel.


Docker administra o ambiente de execucao:

```bash
docker compose up -d
docker compose exec app php artisan migrate
```

Neste projeto, o Composer roda dentro do container para que a maquina local nao precise ter PHP instalado.

-------------

