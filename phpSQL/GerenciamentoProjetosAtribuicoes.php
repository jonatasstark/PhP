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

// Criação da tabela projetos
$sql_projetos = "CREATE TABLE IF NOT EXISTS projetos (
    id_projeto INT AUTO_INCREMENT PRIMARY KEY,
    nome_projeto VARCHAR(255) NOT NULL,
    descricao TEXT
)";

// Executar a query
if ($conn->query($sql_projetos) === TRUE) {
    echo "Tabela 'projetos' criada com sucesso\n";
} else {
    echo "Erro ao criar tabela 'projetos': " . $conn->error;
}

// Criação da tabela atribuicoes
$sql_atribuicoes = "CREATE TABLE IF NOT EXISTS atribuicoes (
    id_atribuicao INT AUTO_INCREMENT PRIMARY KEY,
    id_projeto INT,
    id_funcionario INT,
    FOREIGN KEY (id_projeto) REFERENCES projetos(id_projeto),
    FOREIGN KEY (id_funcionario) REFERENCES funcionarios(id_funcionario)
)";

// Executar a query
if ($conn->query($sql_atribuicoes) === TRUE) {
    echo "Tabela 'atribuicoes' criada com sucesso\n";
} else {
    echo "Erro ao criar tabela 'atribuicoes': " . $conn->error;
}

// Função para inserir dados na tabela projetos
function inserirDadosProjetos($conn, $nome_projeto, $descricao) {
    if (!empty($nome_projeto)) {
        $sql = "INSERT INTO projetos (nome_projeto, descricao) VALUES ('$nome_projeto', '$descricao')";

        if ($conn->query($sql) === TRUE) {
            echo "Dados inseridos com sucesso em 'projetos'!\n";
        } else {
            echo "Erro ao cadastrar em 'projetos': " . $conn->error;
        }
    } else {
        echo "Por favor, preencha todos os campos do formulário.\n";
    }
}

// Função para inserir dados na tabela atribuicoes
function inserirDadosAtribuicoes($conn, $id_projeto, $id_funcionario) {
    if (!empty($id_projeto) && !empty($id_funcionario)) {
        $sql = "INSERT INTO atribuicoes (id_projeto, id_funcionario) VALUES ('$id_projeto', '$id_funcionario')";

        if ($conn->query($sql) === TRUE) {
            echo "Dados inseridos com sucesso em 'atribuicoes'!\n";
        } else {
            echo "Erro ao cadastrar em 'atribuicoes': " . $conn->error;
        }
    } else {
        echo "Por favor, preencha todos os campos do formulário.\n";
    }
}
?>