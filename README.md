# Teste Técnico – Cadastro de Fornecedores

Este projeto consiste em uma API RESTful desenvolvida em Laravel 9.x para cadastro e gerenciamento de fornecedores, permitindo também a busca por CNPJ/CPF via uma API pública.

## Requisitos

- PHP >= 8.1
- Composer
- Laravel 9.x
- PostgreSQL ou MySQL
- L5-Swagger (para documentação da API)

## Instalação

1. Instale as dependências:
composer install

2. Copie o arquivo de ambiente:
cp .env.example .env

3. Configure o `.env` com os dados do seu banco:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=fornecedores
DB_USERNAME=root
DB_PASSWORD=senha

4. Gere a chave da aplicação:
php artisan key:generate

5. Execute as migrations e os seeders:
php artisan migrate --seed

6. Inicie o servidor:
php artisan serve

O projeto estará acessível em http://localhost:8000

## Documentação da API (Swagger)

Para gerar a documentação Swagger:

php artisan l5-swagger:generate

Acesse a documentação em:

http://localhost:8000/api/documentation

## Endpoints disponíveis

GET      /api/fornecedores              → Lista todos os fornecedores  
POST     /api/fornecedores              → Cria um novo fornecedor  
GET      /api/fornecedores/{id}         → Exibe um fornecedor pelo ID  
PUT      /api/fornecedores/{id}         → Atualiza um fornecedor  
DELETE   /api/fornecedores/{id}         → Remove um fornecedor  
GET      /api/consulta/{documento}      → Consulta externa por CNPJ ou CPF

## Observações

- A busca externa utiliza a API BrasilAPI.
- Nenhuma autenticação é necessária para facilitar os testes.
- As respostas são retornadas em JSON.
- Mensagens de erro seguem o padrão:
  { "message": "Fornecedor não encontrado." }
