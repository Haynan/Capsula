# Capsula Corretora

Sistema web monolitico em Laravel 12 para a V1 da Capsula Corretora, com site institucional publico, captacao de leads e painel administrativo interno em `/admin`.

## Visao geral

O projeto foi desenhado para um operador unico na V1, com foco em:

- landing page institucional premium em pt-BR
- captacao de leads pelo site
- painel administrativo para leads, clientes, oportunidades, propostas, renovacoes, produtos e parceiros
- historico simplificado do que o cliente contratou
- envio de e-mail SMTP ao receber novo lead
- compatibilidade realista com hospedagem compartilhada Hostinger Premium

## Stack

- PHP 8.2+
- Laravel 12
- Blade
- Tailwind CSS
- Alpine.js
- Livewire 3 instalado para evolucoes pontuais no admin
- MySQL/MariaDB para producao na Hostinger Premium
- Laravel Breeze com autenticacao Blade

## Requisitos

- PHP 8.2 ou superior
- Composer 2+
- Node.js 20+ e npm apenas no ambiente local/de build
- MySQL 8+ ou MariaDB compativel

## Instalacao local

1. Clone o projeto.
2. Instale as dependencias PHP:

```bash
composer install
```

3. Instale as dependencias de frontend:

```bash
npm install
```

4. Copie o ambiente:

```bash
cp .env.example .env
```

5. Gere a chave da aplicacao:

```bash
php artisan key:generate
```

## Configuracao do `.env`

O projeto esta preparado para MySQL/MariaDB em producao, que e o caminho documentado e suportado pelo plano Hostinger Premium.

SQLite pode ser usado localmente para desenvolvimento e testes quando `pdo_sqlite`/`sqlite3` estiverem habilitados no PHP, mas nao deve ser tratado como banco padrao de producao na Hostinger Premium sem confirmacao direta no painel/suporte da conta. A documentacao publica do plano destaca MySQL/phpMyAdmin e limite de bancos MySQL; nao ha garantia publica equivalente para SQLite.

Exemplo minimo:

```env
APP_NAME="Capsula Corretora"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost
APP_TIMEZONE=America/Fortaleza

APP_LOCALE=pt_BR
APP_FALLBACK_LOCALE=pt_BR
APP_FAKER_LOCALE=pt_BR

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=capsula
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync
FILESYSTEM_DISK=public

MAIL_MAILER=smtp
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS="contato@capsulacorretora.com.br"
MAIL_FROM_NAME="${APP_NAME}"

ADMIN_NAME="Administrador"
ADMIN_EMAIL=admin@capsulacorretora.com.br
ADMIN_PASSWORD=
```

## Banco de dados, migrations e seed

Crie o banco MySQL/MariaDB e rode:

```bash
php artisan migrate --seed
```

Isso cria:

- configuracoes institucionais iniciais
- produtos padrao da corretora
- parceiros importados a partir dos logos existentes em `logos/`
- admin inicial se `ADMIN_EMAIL` e `ADMIN_PASSWORD` estiverem preenchidos

## Criacao do admin

Opcao 1, via `.env` e seed:

```bash
php artisan migrate --seed
```

Opcao 2, via comando Artisan:

```bash
php artisan capsula:create-admin
```

Tambem e possivel passar tudo por opcao:

```bash
php artisan capsula:create-admin --name="Administrador" --email="admin@capsulacorretora.com.br" --password="senha-forte"
```

## Build de assets

Para desenvolvimento:

```bash
npm run dev
```

Para producao:

```bash
npm run build
```

No plano Premium da Hostinger, nao dependa de Node.js no servidor para compilar assets. Rode `npm run build` localmente ou em um ambiente de CI e envie a pasta `public/build` junto com o projeto.

## Storage link

Os logos de parceiros ficam no disco `public`. Gere o link simbolico:

```bash
php artisan storage:link
```

## SMTP

O envio de lead usa o mailer SMTP configurado no `.env`.

Campos principais:

- `MAIL_MAILER=smtp`
- `MAIL_HOST`
- `MAIL_PORT`
- `MAIL_USERNAME`
- `MAIL_PASSWORD`
- `MAIL_FROM_ADDRESS`
- `MAIL_FROM_NAME`

Se o envio falhar, o lead continua salvo e a falha e registrada em log.

## Testes

Execute:

```bash
php artisan test
```

Observacao:

- o runtime principal da aplicacao esta configurado para MySQL/MariaDB
- a suite automatizada usa SQLite em memoria apenas para testes rapidos e isolados

## Deploy em Hostinger Premium

Checklist recomendado:

1. Criar banco MySQL/MariaDB no painel da Hostinger.
2. Enviar o projeto para a hospedagem.
3. Apontar o dominio para a pasta `public/`.
4. Configurar o `.env` com as credenciais reais do banco MySQL, SMTP e `APP_URL` do dominio.
5. Garantir que `public/build` foi gerado localmente com `npm run build` e enviado para a hospedagem.
6. Rodar no servidor via SSH:

```bash
composer install --no-dev --optimize-autoloader
php artisan key:generate
php artisan migrate --seed --force
php artisan storage:link
```

7. Otimizar caches:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Permissoes

Garanta escrita em:

- `storage/`
- `bootstrap/cache/`

## Cache e manutencao

Limpar caches:

```bash
php artisan optimize:clear
```

Regerar caches:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Scheduler e cron

A V1 nao depende criticamente de processos persistentes nem de scheduler para funcionamento principal.

Se quiser habilitar o scheduler no futuro, use um cron simples:

```bash
* * * * * php /caminho/do/projeto/artisan schedule:run >> /dev/null 2>&1
```

## Observacoes importantes para ambiente compartilhado

- a aplicacao nao depende de Redis
- a fila esta em `sync`
- nao ha necessidade de worker permanente
- nao ha dependencia de Supervisor, Horizon, Octane ou websocket
- Node.js nao e requisito em producao; os assets compilados ficam em `public/build`
- o banco recomendado para producao e MySQL/MariaDB da Hostinger
- SQLite fica restrito a ambiente local/testes, salvo confirmacao explicita de suporte na conta
- a estrutura foi pensada para operacao em hospedagem compartilhada

## Rotas principais

Publico:

- `/`
- `/parceiros`
- `/contato`
- `/politica-de-privacidade`
- `POST /solicitar-proposta`

Admin:

- `/admin`
- `/admin/leads`
- `/admin/clientes`
- `/admin/oportunidades`
- `/admin/propostas`
- `/admin/renovacoes`
- `/admin/produtos`
- `/admin/parceiros`
- `/admin/configuracoes`
- `/admin/perfil`
