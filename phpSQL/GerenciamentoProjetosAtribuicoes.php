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

// Inserir os dados dos projetos
$projeto1 = "Sistema de Controle";
$descricao1 = "Desenvolvimento de um sistema interno";
inserirDadosProjetos($conn, $projeto1, $descricao1);

$projeto2 = "Portal Corporativo";
$descricao2 = "Desenvolvimento de um portal para clientes";
inserirDadosProjetos($conn, $projeto2, $descricao2);

// Inserir os dados das atribuições
$idprojeto1 = 1;
$idfuncionario1 = 1;
inserirDadosAtribuicoes($conn, $idprojeto1, $idfuncionario1);

$idprojeto2 = 2;
$idfuncionario2 = 2;
inserirDadosAtribuicoes($conn, $idprojeto2, $idfuncionario2);

// função para deletar um projeto com base no ID
function deletarDadosProjetos($conn, $idProjeto) {
    $sql = "DELETE FROM projetos WHERE id_projeto = '$idProjeto'"; // remove uma linha da tabela

    if ($conn->query($sql) === TRUE) {
        echo "Projeto deletado com sucesso\n";

        $sql2 = "DELETE FROM atribuicoes WHERE id_atribuicao = '$idProjeto'";

        if ($conn->query($sql2) === TRUE) { // se o id inserido for encontrado, as atribuições também serão removidas
            echo "Atribuições relacionadas ao projeto deletado também foram removidas";
        }
    
    } else {
        echo "Erro ao deletar, verifique o id";
    }
}

deletarDadosProjetos($conn, 1);
?>