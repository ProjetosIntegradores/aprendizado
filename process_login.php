<?php

// Verificar se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Capturar os dados do formulário
    $username = $_POST['username'];
    $password = $_POST['password'];

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

    // Consultar o banco de dados para verificar o login
    $sql = "SELECT * FROM login WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verificar a senha
        if (password_verify($password, $user['password'])) {
            echo "Login bem-sucedido!";
        } else {
            echo "Senha incorreta.";
        }
    } else {
        echo "Usuário não encontrado.";
    }


} else {
    echo "Método de requisição inválido.";
}

?>