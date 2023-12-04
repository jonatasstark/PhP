<?php
//Jonatas Gabriel
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pessoas";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Criação das tabelas
$sql_usuarios = "CREATE TABLE IF NOT EXISTS usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL
)";

// Executar a query
if ($conn->query($sql_usuarios) === TRUE) {
    echo "Tabela 'usuarios' criada com sucesso\n";
} else {
    echo "\nErro ao criar tabela: " . $conn->error;
}

// Criação das tabelas
$sql_pedido = "CREATE TABLE IF NOT EXISTS pedido (
    id_pedido INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    produto VARCHAR(100) NOT NULL,
    quantidade INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
)";

// Executar a query
if ($conn->query($sql_pedido) === TRUE) {
    echo "Tabela 'pedido' criada com sucesso\n";
} else {
    echo "\nErro ao criar tabela: " . $conn->error;
}

//inserir dados usuarios
function inserirDadosUsuarios($conn, $nome, $email) {
    if (!empty($nome) && !empty($email)) {
        $sql = "INSERT INTO usuarios (nome, email) VALUES ('$nome', '$email')";

        if ($conn->query($sql) === TRUE) {
            echo "Dados inseridos com sucesso em 'usuarios'!\n";
        } else {
            echo "\nErro ao cadastrar: " . $conn->error;
        }
    } else {
        echo "Por favor, preencha todos os campos do formulário.\n";
    }
}

//inserir dados pedido
function inserirDadosPedido($conn, $produto, $quantidade) {
    if (!empty($produto) && !empty($quantidade)) {
        $sql = "INSERT INTO pedido (produto, quantidade) VALUES ('$produto', '$quantidade')";

        if ($conn->query($sql) === TRUE) {
            echo "Dados inseridos com sucesso em 'pedido'!\n";
        } else {
            echo "\nErro ao cadastrar: " . $conn->error;
        }
    } else {
        echo "Por favor, preencha todos os campos do formulário.\n";
    }
}

?>