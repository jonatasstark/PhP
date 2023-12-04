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
$sql_clientes = "CREATE TABLE IF NOT EXISTS clientes (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL
)";

// Executar a query
if ($conn->query($sql_clientes) === TRUE) {
    echo "Tabela 'clientes' criada com sucesso\n";
} else {
    echo "\nErro ao criar tabela: " . $conn->error;
}

// Criação das tabelas
$sql_vendas = "CREATE TABLE IF NOT EXISTS vendas (
    id_venda INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT,
    produto_vendido VARCHAR(255) NOT NULL,
    valor DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente)
)";

// Executar a query
if ($conn->query($sql_vendas) === TRUE) {
    echo "Tabela 'vendas' criada com sucesso\n";
} else {
    echo "\nErro ao criar tabela: " . $conn->error;
}

//inserir dados clientes
function inserirDadosClientes($conn, $nome, $email) {
    if (!empty($nome) && !empty($email)) {
        $sql = "INSERT INTO clientes (nome, email) VALUES ('$nome', '$email')";

        if ($conn->query($sql) === TRUE) {
            echo "Dados inseridos com sucesso em 'clientes'!\n";
        } else {
            echo "\nErro ao cadastrar: " . $conn->error;
        }
    } else {
        echo "Por favor, preencha todos os campos do formulário.\n";
    }
}

//inserir dados vendas
function inserirDadosVendas($conn, $produto_vendido, $valor) {
    if (!empty($produto_vendido) && !empty($valor)) {
        $sql = "INSERT INTO vendas (produto_vendido, valor) VALUES ('$produto_vendido', '$valor')";

        if ($conn->query($sql) === TRUE) {
            echo "Dados inseridos com sucesso em 'vendas'!\n";
        } else {
            echo "\nErro ao cadastrar: " . $conn->error;
        }
    } else {
        echo "Por favor, preencha todos os campos do formulário.\n";
    }
}

?>