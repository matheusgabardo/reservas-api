Documentação da Aplicação: Sistema de Autenticação e Gerenciamento de Reservas de Coworking
Visão Geral
A aplicação desenvolvida tem como objetivo fornecer uma plataforma para autenticação de usuários e gerenciamento de salas de coworking, incluindo funcionalidades para reserva de salas, exibição de informações detalhadas sobre as salas e controle de status das reservas. Esta aplicação foi criada para a disciplina "Análise e Desenvolvimento de Sistemas" e visa praticar conceitos de Programação para Dispositivos Móveis, Backend com Laravel, Autenticação e Autorização, além de demonstrar o uso de APIs RESTful e Swagger para documentação de rotas.

Objetivo
Autenticação de Usuários: Permitir que os usuários se registrem, façam login e realizem logout na plataforma utilizando autenticação baseada em token com o Laravel Sanctum.

Gerenciamento de Reservas de Coworking: Administradores podem cadastrar salas de coworking, gerenciar a capacidade, o valor por hora, e outras informações. Usuários podem realizar reservas para essas salas.

Documentação de API: A API foi documentada utilizando Swagger para proporcionar uma interface visual para os desenvolvedores interagirem com as rotas.

Funcionalidades
1. Autenticação de Usuários
Registro de Usuário: O usuário pode criar uma conta fornecendo e-mail e senha.

Login de Usuário: Usuários autenticados podem obter um token JWT que é usado para acessar as rotas protegidas.

Logout de Usuário: O usuário pode se deslogar, invalidando seu token de autenticação.

2. Gestão de Salas de Coworking
Cadastro de Salas: Administradores podem adicionar novas salas de coworking, definindo características como nome, endereço, capacidade, valor por hora, e imagens.

Exibição das Salas: Usuários podem visualizar a lista de salas, com detalhes como capacidade e valor por hora.

Avaliação das Salas: Usuários podem avaliar as salas de coworking em uma escala de 1 a 5 estrelas.

3. Reservas de Salas
Reserva de Sala: Usuários podem reservar salas em horários específicos.

Gerenciamento de Status: O administrador pode gerenciar o status das reservas, como 'Concluído' ou 'Cancelado'.

Arquitetura do Sistema
1. Backend
O backend foi desenvolvido utilizando o framework Laravel 12.3.0, com os seguintes componentes principais:

API RESTful: Toda a comunicação com o sistema é realizada por meio de requisições HTTP utilizando os métodos GET, POST, PUT, DELETE.

Autenticação com Laravel Sanctum: A autenticação dos usuários é realizada por meio de tokens JWT. Usuários devem fornecer suas credenciais para obter o token e realizar requisições autenticadas.

Banco de Dados MySQL: O banco de dados armazena informações de usuários, salas de coworking e reservas.

2. Frontend
O frontend é simplificado e foca nas interações com a API para registro, login, e visualização das salas de coworking. Pode ser integrado a qualquer frontend ou aplicativo mobile que consuma a API.

3. Swagger para Documentação
A aplicação utiliza o pacote L5-Swagger para gerar uma documentação interativa da API. Isso facilita a visualização e a interação com as rotas da API por desenvolvedores e usuários.

Tecnologias Utilizadas
Laravel 12.3.0: Framework PHP para o desenvolvimento da API.

Laravel Sanctum: Pacote de autenticação para gerar tokens e proteger rotas.

Swagger: Para documentação interativa da API.

MySQL: Banco de dados para armazenar as informações do sistema.

PHP 8.x: Versão do PHP utilizada.

Composer: Gerenciador de dependências utilizado para instalação do Laravel e pacotes auxiliares.

Rotas da API
1. Autenticação
POST /api/register
Registra um novo usuário.
Parâmetros:

json
Copiar
Editar
{
  "email": "user@mail.com",
  "password": "password123",
  "confirm_password": "password123"
}
Resposta:

json
Copiar
Editar
{
  "token": "your_token_here"
}
POST /api/login
Realiza o login de um usuário e retorna um token de acesso.
Parâmetros:

json
Copiar
Editar
{
  "email": "user@mail.com",
  "password": "password123"
}
Resposta:

json
Copiar
Editar
{
  "token": "your_token_here"
}
POST /api/logout
Realiza o logout do usuário e invalida o token.
Requer autenticação com token.

2. Salas de Coworking
POST /api/rooms
Cria uma nova sala de coworking (protegido para administradores).
Parâmetros:

json
Copiar
Editar
{
  "name": "Sala 1",
  "address": "Rua XYZ, 123",
  "capacity": 10,
  "value_per_hour": 50.00,
  "description": "Sala ideal para reuniões.",
  "image": "image_url"
}
GET /api/rooms
Exibe todas as salas de coworking.

3. Reservas de Salas
POST /api/reservations
Cria uma reserva para uma sala de coworking.
Parâmetros:

json
Copiar
Editar
{
  "room_id": 1,
  "user_id": 1,
  "reservation_date": "2025-12-12",
  "reservation_time": "12:00"
}
Fluxo de Trabalho
1. Cadastro e Login
O usuário inicia o processo criando uma conta, fornecendo seu e-mail e senha. Após o registro, ele pode fazer login utilizando as credenciais criadas e obter um token JWT que será usado para acessar as rotas protegidas da API.

2. Gerenciamento de Salas
Os administradores têm acesso a rotas para cadastrar novas salas de coworking e gerenciar os detalhes dessas salas, incluindo a capacidade, valor por hora e descrição.

3. Reserva de Salas
Usuários podem visualizar as salas de coworking disponíveis e fazer reservas em horários específicos. O status das reservas pode ser alterado pelos administradores.

Conclusão
Essa aplicação oferece uma implementação simples de um sistema de gerenciamento de reservas de coworking com autenticação de usuários e integração com Swagger para documentação. Ela serve como uma excelente base para práticas de desenvolvimento de sistemas com Laravel, RESTful APIs, autenticação, e documentação de APIs.