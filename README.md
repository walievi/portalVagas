## Iniciar projeto

1. Baixar XAMP - PHP e MySQL
2. Baixar Composer
3. Descomentar ZIP no config do Apache
4. Adicionar .env com modelo no arquivo .env.sample
5. npm i artisan

## Rodar projeto

1. composer install ou composer update
2. php artisan migrate
2. rodar: php artisan serve

## Criar controller

1. Sem actions: php artisan make:controller AutenticacaoController
2. CRUD: php artisan make:controller AutenticacaoController –resources


## Adicionar campo 'role' na tabela usuários
1. php artisan make:migration add_role_to_users_table
2. php artisan migrate

## Criar model
1. php artisan make:model Post