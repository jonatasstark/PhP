<?php
// Jonatas Gabriel
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pessoas";

// Conexão banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Criação das tabelas
$sql_fornecedores = "CREATE TABLE IF NOT EXISTS fornecedores (
    id_fornecedor INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    contato VARCHAR(100) NOT NULL
)";

// executar query
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

// executar query
if ($conn->query($sql_compras) === TRUE) {
    echo "Tabela 'compras' criada com sucesso\n";
} else {
    echo "\nErro ao criar tabela: " . $conn->error;
}

// função para inserir dados em fornecedores
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

// função para inserir dados em compras
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

// Inserir os dados dos fornecedores
inserirDadosFornecedores($conn, "Empresa A", "contato@empresaA.com");
inserirDadosFornecedores($conn, "Empresa B", "contato@empresaB.com");

//Inserir os dados das compras
inserirDadosCompras($conn, 1, "Peças de Computador", 100);
inserirDadosCompras($conn, 2, "Material de Escritório", 500);

// função para deletar um fornecedor com base no ID
function deletarDadosFornecedores($conn, $idFornecedor) {
    $sql = "DELETE FROM fornecedores WHERE id_fornecedor = '$idFornecedor'"; // remove uma linha da tabela

    if ($conn->query($sql) === TRUE) {
        echo "Fornecedor deletado com sucesso\n";

        $sql2 = "DELETE FROM compras WHERE id_fornecedor = '$idFornecedor'";

        if ($conn->query($sql2) === TRUE) { // se o id inserido for encontrado, as compras também serão removidas
            echo "Compras relacionadas ao fornecedor deletado também foram removidas";
        }
    
    } else {
        echo "Erro ao deletar, verifique o id";
    }
}

deletarDadosFornecedores($conn, 1);

$conn->close();
?>