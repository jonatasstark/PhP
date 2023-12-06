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
$sql_usuarios = "CREATE TABLE IF NOT EXISTS usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL
)";

// Executar a query
if ($conn->query($sql_usuarios) === TRUE) {
    echo "Tabela 'usuarios' criada com sucesso\n";
} else {
    echo "\nErro ao criar tabela: " . $conn->error;
}

// Criação das tabelas
$sql_pedido = "CREATE TABLE IF NOT EXISTS pedido (
    id_pedido INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    produto VARCHAR(100) NOT NULL,
    quantidade INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
)";

// Executar a query
if ($conn->query($sql_pedido) === TRUE) {
    echo "Tabela 'pedido' criada com sucesso\n";
} else {
    echo "\nErro ao criar tabela: " . $conn->error;
}

//inserir dados usuarios
function inserirDadosUsuarios($conn, $nome, $email) {
    if (!empty($nome) && !empty($email)) {
        $sql = "INSERT INTO usuarios (nome, email) VALUES ('$nome', '$email')";

        if ($conn->query($sql) === TRUE) {
            echo "Dados inseridos com sucesso em 'usuarios'!\n";
        } else {
            echo "\nErro ao cadastrar: " . $conn->error;
        }
    } else {
        echo "Por favor, preencha todos os campos do formulário.\n";
    }
}

//inserir dados pedido
function inserirDadosPedido($conn, $idUsuario, $produto, $quantidade) {
    if (!empty($produto) && !empty($quantidade)) {
        $sql = "INSERT INTO pedido (id_usuario, produto, quantidade) VALUES ('$idUsuario', '$produto', '$quantidade')";

        if ($conn->query($sql) === TRUE) {
            echo "Dados inseridos com sucesso em 'pedido'!\n";
        } else {
            echo "\nErro ao cadastrar: " . $conn->error;
        }
    } else {
        echo "Por favor, preencha todos os campos do formulário.\n";
    }
}

// Inserir dados dos usuários
inserirDadosUsuarios($conn, "Eduardo", "eduardo@example.com");
inserirDadosUsuarios($conn, "Laura", "laura@example.com");
inserirDadosUsuarios($conn, "Rita", "rita@example.com");
inserirDadosUsuarios($conn, "Gabriel", "gabriel@example.com");

// Inserir dados das compras
inserirDadosPedido($conn, 1, "Livro de Ficção", 3);
inserirDadosPedido($conn, 2, "Fones de Ouvido", 1);
inserirDadosPedido($conn, 3, "Cadeira de Escritório", 2);
inserirDadosPedido($conn, 4, "Mochila", 1);

// função para deletar um usuário com base no ID
function deletarDadosUsuarios($conn, $idUsuario) {
    $sql = "DELETE FROM usuarios WHERE id_usuario = '$idUsuario'"; // remove uma linha da tabela

    if ($conn->query($sql) === TRUE) {
        echo "Usuário deletado com sucesso\n";

        $sql2 = "DELETE FROM pedido WHERE id_usuario = '$idUsuario'";

        if ($conn->query($sql2) === TRUE) { // se o id inserido for encontrado, os pedidos também serão removidos
            echo "Pedidos relacionados ao usuário deletado também foram removidos";
        }
    
    } else {
        echo "Erro ao deletar, verifique o id";
    }
}

deletarDadosUsuarios($conn, 1);

?>