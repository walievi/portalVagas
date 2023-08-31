## Iniciar projeto

1. Baixar XAMP - PHP e MySQL
2. Baixar Composer
3. Descomentar ZIP no config do Apache
4. Adicionar .env com modelo no arquivo .env.sample

## Rodar projeto

1. composer install ou composer update
2. rodar: php artisan serve

## Criar controller

1. Sem actions: php artisan make:controller AutenticacaoController
2. CRUD: php artisan make:controller AutenticacaoController –resources
