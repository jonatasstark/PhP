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
$sql_produto = "CREATE TABLE IF NOT EXISTS produto (
    id_produto INT AUTO_INCREMENT PRIMARY KEY,
    nome_produto VARCHAR(255) NOT NULL,
    preco DECIMAL(10,2) NOT NULL
)";

// Executar a query
if ($conn->query($sql_produto) === TRUE) {
    echo "Tabela 'produto' criada com sucesso\n";
} else {
    echo "\nErro ao criar tabela: " . $conn->error;
}

// Criação das tabelas
$sql_categoria = "CREATE TABLE IF NOT EXISTS categoria (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nome_categoria VARCHAR(255) NOT NULL
)";

if ($conn->query($sql_categoria) === TRUE) {
    echo "Tabela 'categoria' criada com sucesso\n";
} else {
    echo "\nErro ao criar tabela: " . $conn->error;
}

//inserir dados produto
function inserirDadosProduto($conn, $nome_produto, $preco) {
    if (!empty($nome_produto) && !empty($preco)) {
        $sql = "INSERT INTO produto (nome_produto, preco) VALUES ('$nome_produto', '$preco')";

        if ($conn->query($sql) === TRUE) {
            echo "Dados inseridos com sucesso em 'produto'!\n";
        } else {
            echo "\nErro ao cadastrar: " . $conn->error;
        }
    } else {
        echo "Por favor, preencha todos os campos do formulário.\n";
    }
}

//inserir dados categoria
function inserirDadosCategoria($conn, $nome_categoria) {
    if (!empty($nome_categoria)) {
        $sql = "INSERT INTO categoria (nome_categoria) VALUES ('$nome_categoria')";

        if ($conn->query($sql) === TRUE) {
            echo "Dados inseridos com sucesso em 'categoria'!\n";
        } else {
            echo "\nErro ao cadastrar: " . $conn->error;
        }
    } else {
        echo "Por favor, preencha todos os campos do formulário.\n";
    }
}

// Inserir dados dos produtos
inserirDadosProduto($conn, "Computador", 2000);

// Inserir dados da categoria
inserirDadosCategoria($conn, "Eletrônico");


?>