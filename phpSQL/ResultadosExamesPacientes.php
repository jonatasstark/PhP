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

$sqlExames = "CREATE TABLE IF NOT EXISTS exames (
    id_exame INT AUTO_INCREMENT PRIMARY KEY,
    tipo_exame VARCHAR(255) NOT NULL,
    resultado VARCHAR(255) NOT NULL
)";

if ($conn->query($sqlExames) === TRUE) {
    echo "Tabela 'exames' criada com sucesso\n";
} else {
    echo "\nErro ao criar tabela: " . $conn->error;
}

$sqlPacientes = "CREATE TABLE IF NOT EXISTS pacientes (
    id_paciente INT AUTO_INCREMENT PRIMARY KEY,
    nome_paciente VARCHAR(255) NOT NULL,
    data_nascimento DATE NOT NULL
)";

if ($conn->query($sqlPacientes) === TRUE) {
    echo "Tabela 'pacientes' criada com sucesso\n";
} else {
    echo "\nErro ao criar tabela: " . $conn->error;
}

function inserirDadosExames($conn, $tipo_exame, $resultado) {
    if (!empty($tipo_exame) && !empty($resultado)) {
        $sql = "INSERT INTO exames (tipo_exame, resultado) VALUES ('$tipo_exame', '$resultado')";

        if ($conn->query($sql) === TRUE) {
            echo "Dados inseridos com sucesso em 'exames'!\n";
        } else {
            echo "\nErro ao cadastrar: " . $conn->error;
        }
    } else {
        echo "Por favor, preencha todos os campos do formulário.\n";
    }
}

function inserirDadosPacientes($conn, $nome_paciente, $data_nascimento) {
    if (!empty($nome_paciente) && !empty($data_nascimento)) {
        $sql = "INSERT INTO pacientes (nome_paciente, data_nascimento) VALUES ('$nome_paciente', '$data_nascimento')";

        if ($conn->query($sql) === TRUE) {
            echo "Dados inseridos com sucesso em 'pacientes'!\n";
        } else {
            echo "\nErro ao cadastrar: " . $conn->error;
        }
    } else {
        echo "Por favor, preencha todos os campos do formulário.\n";
    }
}

$conn->close();

?>