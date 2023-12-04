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
$sql_funcionarios = "CREATE TABLE IF NOT EXISTS funcionarios (
    id_funcionario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    cargo VARCHAR(100) NOT NULL
)";

// Executar a query
if ($conn->query($sql_funcionarios) === TRUE) {
    echo "Tabela 'funcionarios' criada com sucesso\n";
} else {
    echo "\nErro ao criar tabela: " . $conn->error;
}

// Criação das tabelas
$sql_departamentos = "CREATE TABLE IF NOT EXISTS departamentos (
    id_departamento INT AUTO_INCREMENT PRIMARY KEY,
    nome_departamento VARCHAR(255) NOT NULL,
)";

if ($conn->query($sql_departamentos) === TRUE) {
    echo "Tabela 'departamentos' criada com sucesso\n";
} else {
    echo "\nErro ao criar tabela: " . $conn->error;
}


//inserir dados funcionarios
function inserirDadosFuncionarios($conn, $nome, $cargo) {
    if (!empty($nome) && !empty($cargo)) {
        $sql = "INSERT INTO funcionarios (nome, cargo) VALUES ('$nome', '$cargo')";

        if ($conn->query($sql) === TRUE) {
            echo "Dados inseridos com sucesso em 'funcionarios'!\n";
        } else {
            echo "\nErro ao cadastrar: " . $conn->error;
        }
    } else {
        echo "Por favor, preencha todos os campos do formulário.\n";
    }
}

//inserir dados departamentos
function inserirDadosDepartamentos($conn, $nome_departamento) {
    if (!empty($nome_departamento)) {
        $sql = "INSERT INTO departamentos (nome_departamento) VALUES ('$nome_departamento')";

        if ($conn->query($sql) === TRUE) {
            echo "Dados inseridos com sucesso em 'departamentos'!\n";
        } else {
            echo "\nErro ao cadastrar: " . $conn->error;
        }
    } else {
        echo "Por favor, preencha todos os campos do formulário.\n";
    }
}


?>