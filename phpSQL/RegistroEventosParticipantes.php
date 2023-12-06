<?php
// Jonatas Gabriel
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pessoas";

// Conexão Banco de Dados
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Criação das tabelas
$sql_eventos = "CREATE TABLE IF NOT EXISTS eventos (
    id_evento INT AUTO_INCREMENT PRIMARY KEY,
    nome_evento VARCHAR(255) NOT NULL,
    data DATE NOT NULL
)";

// Executar as querys
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

// função para inserir dados em eventos
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

// função para inserir dados em participantes
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

// Inserir dados dos eventos
inserirDadosEventos($conn, "Conferência de Tecnologia", "2023-12-15");
inserirDadosEventos($conn, "Workshop de Marketing Digital", "2023-11-20");

// Inserir dados dos participantes
inserirDadosParticipantes($conn, 1, "Gabriel");
inserirDadosParticipantes($conn, 2, "Sofia");

// função para deletar um evento com base no ID
function deletarDadosEventos($conn, $idEvento) {
    $sql = "DELETE FROM eventos WHERE id_evento = '$idEvento'"; // remove uma linha da tabela

    if ($conn->query($sql) === TRUE) {
        echo "Evento deletado com sucesso\n";

        $sql2 = "DELETE FROM participantes WHERE id_evento = '$idEvento'";

        if ($conn->query($sql2) === TRUE) { // se o id inserido for encontrado, os participantes também serão removidos
            echo "Participantes relacionados ao evento deletado também foram removidos";
        }
    
    } else {
        echo "Erro ao deletar, verifique o id";
    }
}

deletarDadosEventos($conn, 1);

$conn->close();
?>