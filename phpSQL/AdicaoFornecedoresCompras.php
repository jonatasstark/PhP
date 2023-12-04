<?php
// Jonatas Gabriel
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pessoas";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$sql_fornecedores = "CREATE TABLE IF NOT EXISTS fornecedores (
    id_fornecedor INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    contato VARCHAR(100) NOT NULL
)";

if ($conn->query($sql_fornecedores) === TRUE) {
    echo "Tabela 'fornecedores' criada com sucesso\n";
} else {
    echo "\nErro ao criar tabela: " . $conn->error;
}

$sql_compras = "CREATE TABLE IF NOT EXISTS compras (
    id_compra INT AUTO_INCREMENT PRIMARY KEY,
    id_fornecedor INT,
    produto_comprado VARCHAR(255) NOT NULL,
    quantidade INT NOT NULL,
    FOREIGN KEY (id_fornecedor) REFERENCES fornecedores(id_fornecedor)
)";

if ($conn->query($sql_compras) === TRUE) {
    echo "Tabela 'compras' criada com sucesso\n";
} else {
    echo "\nErro ao criar tabela: " . $conn->error;
}

function inserirDadosFornecedores($conn, $nome, $contato) {
    if (!empty($nome) && !empty($contato)) {
        $sql = "INSERT INTO fornecedores (nome, contato) VALUES ('$nome', '$contato')";

        if ($conn->query($sql) === TRUE) {
            echo "Dados inseridos com sucesso em 'fornecedores'!\n";
        } else {
            echo "\nErro ao cadastrar: " . $conn->error;
        }
    } else {
        echo "Por favor, preencha todos os campos do formulário.\n";
    }
}

function inserirDadosCompras($conn, $id_fornecedor, $produto_comprado, $quantidade) {
    if (!empty($id_fornecedor) && !empty($produto_comprado) && !empty($quantidade)) {
        $sql = "INSERT INTO compras (id_fornecedor, produto_comprado, quantidade) VALUES ('$id_fornecedor', '$produto_comprado', '$quantidade')";

        if ($conn->query($sql) === TRUE) {
            echo "Dados inseridos com sucesso em 'compras'!\n";
        } else {
            echo "\nErro ao cadastrar: " . $conn->error;
        }
    } else {
        echo "Por favor, preencha todos os campos do formulário.\n";
    }
}


$conn->close();
?>