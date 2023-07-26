# CRUD - Projeto BackEnd para cadastro de usuários

`->  cadastros.php` se trata de uma página o qual você pode cadastrar a conta bancária de um funcionário no banco de dados;

`->  registros.php` se trata de uma página o qual você pode visualizar os usuários que foram cadastrados no banco de dados
<h3>Intruções para criação do banco de dados adequado:</h3>

Base de dados: `CREATE DATABASE registros`; </br>

Adentrar a base de dados: `USE registros`; </br>

Criação da tabela: `CREATE TABLE funcionarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(30),
    empresa VARCHAR(40),
    banco VARCHAR(30),
    agencia INT NOT NULL,
    contac INT NOT NULL
) CHARSET=utf8;
` </br>

