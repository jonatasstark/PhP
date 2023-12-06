<?php
// Jonatas Gabriel
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pessoas";

// Conexão com banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Criação das tabelas
$sqlExames = "CREATE TABLE IF NOT EXISTS exames (
    id_exame INT AUTO_INCREMENT PRIMARY KEY,
    tipo_exame VARCHAR(255) NOT NULL,
    resultado VARCHAR(255) NOT NULL
)";

// Executar as querys
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

// função para inserir dados em exames
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

// função para inserir dados em pacientes
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

// Inserir dados dos exames
inserirDadosExames($conn, "Exame de Sangue", "Normal");
inserirDadosExames($conn, "Raio-X", "Fratura identificada");

// Inserir dados dos pacientes
inserirDadosPacientes($conn, "Mariana", "1995-06-10");
inserirDadosPacientes($conn, "Rafael", "1987-09-25");

// função para deletar um exame com base no ID
function deletarDadosExames($conn, $idExame) {
    $sql = "DELETE FROM exames WHERE id_exame = '$idExame'"; // remove uma linha da tabela

    if ($conn->query($sql) === TRUE) {
        echo "Exame deletado com sucesso\n";

        $sql2 = "DELETE FROM pacientes WHERE id_paciente = '$idExame'";

        if ($conn->query($sql2) === TRUE) { // se o id inserido for encontrado, os pacientes também serão removidos
            echo "Pacientes relacionados ao exame deletado também foram removidos";
        }
    
    } else {
        echo "Erro ao deletar, verifique o id";
    }
}

deletarDadosExames($conn, 1);

$conn->close();

?>