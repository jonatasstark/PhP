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

$sql_livros = "CREATE TABLE IF NOT EXISTS livros (
    id_livro INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    ano_publicacao INT NOT NULL
)";

if ($conn->query($sql_livros) === TRUE) {
    echo "Tabela 'livros' criada com sucesso\n";
} else {
    echo "\nErro ao criar tabela: " . $conn->error;
}

$sql_autores = "CREATE TABLE IF NOT EXISTS autores (
    id_autor INT AUTO_INCREMENT PRIMARY KEY,
    nome_autor VARCHAR(255) NOT NULL
)";

if ($conn->query($sql_autores) === TRUE) {
    echo "Tabela 'autores' criada com sucesso\n";
} else {
    echo "\nErro ao criar tabela: " . $conn->error;
}

function inserirDadosLivros($conn, $titulo, $ano_publicacao) {
    if (!empty($titulo) && !empty($ano_publicacao)) {
        $sql = "INSERT INTO livros (titulo, ano_publicacao) VALUES ('$titulo', '$ano_publicacao')";

        if ($conn->query($sql) === TRUE) {
            echo "Dados inseridos com sucesso em 'livros'!\n";
        } else {
            echo "\nErro ao cadastrar: " . $conn->error;
        }
    } else {
        echo "Por favor, preencha todos os campos do formulário.\n";
    }
}

function inserirDadosAutores($conn, $nome_autor) {
    if (!empty($nome_autor)) {
        $sql = "INSERT INTO autores (nome_autor) VALUES ('$nome_autor')";

        if ($conn->query($sql) === TRUE) {
            echo "Dados inseridos com sucesso em 'autores'!\n";
        } else {
            echo "\nErro ao cadastrar: " . $conn->error;
        }
    } else {
        echo "Por favor, preencha todos os campos do formulário.\n";
    }
}


$conn->close();
?>