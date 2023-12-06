<?php
// Jonatas Gabriel
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
$sql_alunos = "CREATE TABLE IF NOT EXISTS alunos (
    id_aluno INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    turma VARCHAR(100) NOT NULL
)";

// Executar a query
if ($conn->query($sql_alunos) === TRUE) {
    echo "Tabela 'alunos' criada com sucesso\n";
} else {
    echo "\nErro ao criar tabela: " . $conn->error;
}

$sql_cursos = "CREATE TABLE IF NOT EXISTS cursos (
    id_curso INT AUTO_INCREMENT PRIMARY KEY,
    nome_curso VARCHAR(255) NOT NULL,
    instrutor VARCHAR(100) NOT NULL
)";

// Executar a query
if ($conn->query($sql_cursos) === TRUE) {
    echo "Tabela 'cursos' criada com sucesso\n";
} else {
    echo "\nErro ao criar tabela: " . $conn->error;
}

// Inserir dados na tabela 'alunos'
function inserirDadosAlunos($conn, $nome, $turma) {
    if (!empty($nome) && !empty($turma)) {
        $sql = "INSERT INTO alunos (nome, turma) VALUES ('$nome', '$turma')";

        if ($conn->query($sql) === TRUE) {
            echo "Dados inseridos com sucesso em 'alunos'!\n";
        } else {
            echo "\nErro ao cadastrar: " . $conn->error;
        }
    } else {
        echo "Por favor, preencha todos os campos do formulário.\n";
    }
}

// Inserir dados na tabela 'cursos'
function inserirDadosCursos($conn, $nome_curso, $instrutor) {
    if (!empty($nome_curso) && !empty($instrutor)) {
        $sql = "INSERT INTO cursos (nome_curso, instrutor) VALUES ('$nome_curso', '$instrutor')";

        if ($conn->query($sql) === TRUE) {
            echo "Dados inseridos com sucesso em 'cursos'!\n";
        } else {
            echo "\nErro ao cadastrar: " . $conn->error;
        }
    } else {
        echo "Por favor, preencha todos os campos do formulário.\n";
    }
}

// Inserir os dados dos alunos
$aluno1 = "Lucas";
$turma1 = "Turma A";
inserirDadosAlunos($conn, $aluno1, $turma1);

$aluno2 = "Julia";
$turma2 = "Turma B";
inserirDadosAlunos($conn, $aluno2, $turma2);

inserirDadosAlunos($conn, "Paulo", "Turma C");

inserirDadosAlunos($conn, "Lúcia", "Turma B");

// Inserir os dados dos cursos
$curso1 = "Matemática";
$professor1 = "Professor Carlos";
inserirDadosCursos($conn, $curso1, $professor1);

$curso2 = "Ciências";
$professor2 = "Professora Ana";
inserirDadosCursos($conn, $curso2, $professor2);

inserirDadosCursos($conn, "História", "Professor Martins");

inserirDadosCursos($conn, "Geografia", "Professora Silva");

// função para deletar um aluno com base no ID
function deletarDadosAlunos($conn, $idAluno) {
    $sql = "DELETE FROM alunos WHERE id_aluno = '$idAluno'"; // remove uma linha da tabela

    if ($conn->query($sql) === TRUE) {
        echo "Aluno deletado com sucesso\n";

        $sql2 = "DELETE FROM cursos WHERE id_curso = '$idAluno'";

        if ($conn->query($sql2) === TRUE) { // se o id inserido for encontrado, os cursos também serão removidos
            echo "Cursos relacionados ao aluno deletado também foram removidos";
        }
    
    } else {
        echo "Erro ao deletar, verifique o id";
    }
}

deletarDadosAlunos($conn, 1);

$conn->close();
?>