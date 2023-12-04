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

$sql_eventos = "CREATE TABLE IF NOT EXISTS eventos (
    id_evento INT AUTO_INCREMENT PRIMARY KEY,
    nome_evento VARCHAR(255) NOT NULL,
    data DATE NOT NULL
)";

if ($conn->query($sql_eventos) === TRUE) {
    echo "Tabela 'eventos' criada com sucesso\n";
} else {
    echo "\nErro ao criar tabela: " . $conn->error;
}

$sql_participantes = "CREATE TABLE IF NOT EXISTS participantes (
    id_participante INT AUTO_INCREMENT PRIMARY KEY,
    id_evento INT NOT NULL,
    nome_participante VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_evento) REFERENCES eventos(id_evento)
)";

if ($conn->query($sql_participantes) === TRUE) {
    echo "Tabela 'participantes' criada com sucesso\n";
} else {
    echo "\nErro ao criar tabela: " . $conn->error;
}

function inserirDadosEventos($conn, $nome_evento, $data) {
    if (!empty($nome_evento) && !empty($data)) {
        $sql = "INSERT INTO eventos (nome_evento, data) VALUES ('$nome_evento', '$data')";

        if ($conn->query($sql) === TRUE) {
            echo "Dados inseridos com sucesso em 'eventos'!\n";
        } else {
            echo "\nErro ao cadastrar: " . $conn->error;
        }
    } else {
        echo "Por favor, preencha todos os campos do formulário.\n";
    }
}

function inserirDadosParticipantes($conn, $id_evento, $nome_participante) {
    if (!empty($id_evento) && !empty($nome_participante)) {
        $sql = "INSERT INTO participantes (id_evento, nome_participante) VALUES ('$id_evento', '$nome_participante')";

        if ($conn->query($sql) === TRUE) {
            echo "Dados inseridos com sucesso em 'participantes'!\n";
        } else {
            echo "\nErro ao cadastrar: " . $conn->error;
        }
    } else {
        echo "Por favor, preencha todos os campos do formulário.\n";
    }
}

$conn->close();
?>