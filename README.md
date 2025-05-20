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

### 1. Clone o repositório

```bash
git clone https://github.com/seu-usuario/seu-repo.git
cd seu-repo

### 2. Instale as dependências
```bash
composer install

### 3. Copie o arquivo de ambiente
```bash
cp .env.example .env

### 4. Configure o banco de dados SQLite
```bash
touch database/database.sqlite

#### Edite o arquivo .env e configure o banco de dados:
```bash
DB_CONNECTION=sqlite
DB_DATABASE=${PWD}/database/database.sqlite

### 5. Gere a chave da aplicação
```bash
php artisan key:generate

### 6. Execute as migrations
```bash
php artisan migrate

### 7. Inicie o servidor
```bash
php artisan serve

O projeto estará disponível em: http://127.0.0.1:8000


📬 Endpoints da API
Todos os endpoints seguem o prefixo /api.

✅ Consultar saldo
###GET /api/wallets

Resposta:
json
{
  "walletId": 1,
  "balance": 150.00
}

💸 Depositar valor
###POST /api/wallets

Body (JSON):
json
{
  "amount": 100.00
}
Resposta:
{
  "message": "Depósito realizado com sucesso",
  "newBalance": 250.00
}

🏧 Sacar valor
###POST /api/wallets/withdrawal

Body (JSON):
json
{
  "amount": 50.00
}
Resposta:
json
{
  "message": "Saque realizado com sucesso",
  "newBalance": 200.00
}

🔁 Transferência simulada
###POST /api/wallets/transfer

Simula a transferência de um valor de uma carteira para uma segunda carteira (criada automaticamente).

Body (JSON):

json
{
  "amount": 75.00
}
Resposta:
json
{
  "message": "Transferência realizada com sucesso",
  "transferredAmount": 75.0,
  "originWalletBalance": 125.0,
  "destinationWalletBalance": 75.0
}

🧪 Testando a API
Use ferramentas como Postman ou Insomnia para testar os endpoints da API.
