# 💰 API de Carteira Digital Simples (Laravel)

Este projeto é uma **API RESTful** básica que simula o funcionamento de uma carteira digital. Ele permite:

- Consultar o saldo da carteira
- Realizar depósitos
- Realizar saques
- Simular uma transferência bancária para uma segunda carteira (sem usuários)

## 🚀 Tecnologias

- **PHP 8.2+**
- **Laravel 11**
- **SQLite** (padrão para simplicidade)
- Ferramentas para testes de API:
  - [Postman](https://www.postman.com/downloads/)
  - [Insomnia](https://insomnia.rest/download)

## ⚙️ Como rodar o projeto

Siga os passos abaixo para rodar a API em sua máquina local.

1. Clone o repositório:
git clone https://github.com/seu-usuario/seu-repo.git
cd seu-repo

Instale as dependências:
composer install

Copie o arquivo de ambiente:
cp .env.example .env

Configure o banco de dados SQLite:
touch database/database.sqlite

Edite o arquivo .env e configure o banco de dados:
DB_CONNECTION=sqlite
DB_DATABASE=${PWD}/database/database.sqlite

Gere a chave da aplicação:
php artisan key:generate

Execute as migrations:
php artisan migrate

Inicie o servidor:
php artisan serve

O projeto estará disponível em: http://127.0.0.1:8000

📬 Endpoints da API
Todos os endpoints seguem o prefixo /api.

✅ Consultar saldo
GET /api/wallets

Resposta:
{ "walletId": 1, "balance": 150.00 }

💸 Depositar valor
POST /api/wallets

Body (JSON):
{ "amount": 100.00 }

Resposta:
{ "message": "Depósito realizado com sucesso", "newBalance": 250.00 }

🏧 Sacar valor
POST /api/wallets/withdrawal

Body (JSON):
{ "amount": 50.00 }

Resposta:
{ "message": "Saque realizado com sucesso", "newBalance": 200.00 }

🔁 Transferência simulada
POST /api/wallets/transfer

Simula a transferência de um valor de uma carteira para uma segunda carteira (criada automaticamente).

Body (JSON):
{ "amount": 75.00 }

Resposta:
{ "message": "Transferência realizada com sucesso", "transferredAmount": 75.0, "originWalletBalance": 125.0, "destinationWalletBalance": 75.0 }

🧪 Testando a API
Use ferramentas como Postman ou Insomnia para testar os endpoints da API.
