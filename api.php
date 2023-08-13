<?php

// Configurações do banco de dados
$host = "localhost"; // Endereço do servidor de banco de dados
$username = "seu_usuario"; // Nome de usuário do banco de dados
$password = "sua_senha"; // Senha do banco de dados
$dbname = "dados_pessoais"; // Nome do banco de dados

// Conectando ao banco de dados
$mysqli = new mysqli($host, $username, $password, $dbname);

// Verificando a conexão
if ($mysqli->connect_error) {
    die("Erro na conexão: " . $mysqli->connect_error);
}

// Definindo o cabeçalho para permitir requisições de qualquer origem (CORS)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Verificando o método da requisição
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Consulta SQL para obter os dados
    $sql = "SELECT nome, idade, estado, ano_nascimento FROM pessoas";
    $result = $mysqli->query($sql);

    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Retornando os dados como JSON
    echo json_encode($data);
} else {
    http_response_code(405); // Método não permitido
    echo json_encode(array("mensagem" => "Método não permitido."));
}

$mysqli->close();
?>
