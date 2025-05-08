<?php

$servername = "localhost"; // Nome do servidor
$username = "root"; // Usuário do banco de dados
$password = ""; // Senha do banco de dados
$dbname = "meu_banco"; // Nome do banco de dados que será criado

// Criar conexão com o servidor
$conn = new mysqli($servername, $username, $password);

// Verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Criar o banco de dados apenas se não existir
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Banco de dados criado com sucesso ou já existente!";
} else {
    echo "Erro ao criar o banco de dados: " . $conn->error;
}

// Selecionar o banco de dados
$conn->select_db($dbname);

// Criar a tabela de login
$sql = "CREATE TABLE login (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabela de login criada com sucesso!";
} else {
    echo "Erro ao criar a tabela de login: " . $conn->error;
}



?>
