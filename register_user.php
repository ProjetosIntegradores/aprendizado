<?php

// Verificar se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Capturar os dados do formulário
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash da senha para segurança
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Conectar ao banco de dados
    $servername = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "meu_banco";

    $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

    // Verificar conexão
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Inserir o usuário no banco de dados
    $sql = "INSERT INTO login (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $hashedPassword);

    if ($stmt->execute()) {
        echo "Usuário cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar o usuário: " . $stmt->error;
    }

} else {
    echo "Método de requisição inválido.";
}

?>