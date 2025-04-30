# Sistema de Autenticação e Reservas de Coworking

## Descrição

Este sistema oferece funcionalidades para autenticação de usuários, gerenciamento de salas de coworking e reserva de salas. Criado para a disciplina "Análise e Desenvolvimento de Sistemas", a aplicação utiliza Laravel 12.3.0 e Sanctum para autenticação via token.

## Funcionalidades
- Autenticação de Usuários: Registro, login e logout com geração de token JWT.

- Gerenciamento de Salas: Cadastro, exibição e avaliação de salas de coworking.

- Reserva de Salas: Usuários podem reservar salas, e administradores gerenciam o status das reservas.

## Tecnologias Utilizadas

- **Backend: Laravel 12.3.0, Laravel Sanctum.** 
- **Banco de Dados: MySQL.** 
- **Documentação de API: Swagger.**


## Rotas Principais


```plaintext
1. Autenticação
    POST /api/register: Registra um novo usuário.

    POST /api/login: Realiza o login e retorna um token de autenticação.

    POST /api/logout: Realiza o logout do usuário.

2. Salas de Coworking
    POST /api/rooms: Cadastra uma nova sala de coworking (admin).

    GET /api/rooms: Exibe as salas cadastradas.

3. Reservas
    POST /api/reservations: Realiza uma reserva para uma sala.
```

## Como Rodar

## Clone o repositório.

### Instale as dependências com o comando:
```bash
    composer install
```
### Configure o banco de dados no .env e execute as migrations:

```bash
    php artisan migrate
```
### Inicie o servidor:
```bash
    php artisan serve
```