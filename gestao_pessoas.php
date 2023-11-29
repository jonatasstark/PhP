<?php
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
$sql_pessoas = "CREATE TABLE IF NOT EXISTS pessoas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    idade INT NOT NULL
)";
 
// Executar a query
if ($conn->query($sql_pessoas) === TRUE) {
    echo "Tabela 'pessoas' criada com sucesso\n";
} else {
    echo "\nErro ao criar tabela: " . $conn->error;
}

$sql_enderecos = "CREATE TABLE IF NOT EXISTS enderecos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    rua VARCHAR(255) NOT NULL,
    cidade VARCHAR(100) NOT NULL,
    id_pessoa INT,
    FOREIGN KEY (id_pessoa) REFERENCES pessoas(id) ON UPDATE CASCADE
)";

if ($conn->query($sql_enderecos) === TRUE) {
    echo "Tabela 'enderecos' criada com sucesso\n";
} else {
    echo "\nErro ao criar tabela: " . $conn->error;
}

$sql_telefones = "CREATE TABLE IF NOT EXISTS telefones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numero VARCHAR(20) NOT NULL,
    tipo VARCHAR(50) NOT NULL,
    id_pessoa INT,
    FOREIGN KEY (id_pessoa) REFERENCES pessoas(id) ON UPDATE CASCADE
)";

if ($conn->query($sql_telefones) === TRUE) {
    echo "Tabela 'telefones' criada com sucesso\n";
} else {
    echo "\nErro ao criar tabela: " . $conn->error;
}

$sql_pedidos = "CREATE TABLE IF NOT EXISTS pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(255) NOT NULL,
    valor DECIMAL(10, 2) NOT NULL,
    id_pessoa INT,
    FOREIGN KEY (id_pessoa) REFERENCES pessoas(id) ON UPDATE CASCADE
)";

if ($conn->query($sql_pedidos) === TRUE) {
    echo "Tabela 'pedidos' criada com sucesso\n";
} else {
    echo "\nErro ao criar tabela: " . $conn->error;
}

// Exercício 1

function inserirDadosPessoas($conn, $nome, $idade) {
    if (!empty($nome) && !empty($idade)) {
        $sql = "INSERT INTO pessoas (nome, idade) VALUES ('$nome', $idade)";

        if ($conn->query($sql) === TRUE) {
            echo "Dados inseridos com sucesso em 'pessoas'!\n";
        } else {
            echo "\nErro ao cadastrar: " . $conn->error;
        }
    } else {
        echo "Por favor, preencha todos os campos do formulário.\n";
    }
}

$nome = "Gabriel";
$idade = 6;
inserirDadosPessoas($conn, $nome, $idade);

function inserirDadosEnderecos($conn, $rua, $cidade) {
    if (!empty($rua) && !empty($cidade)) {
        $sql = "INSERT INTO enderecos (rua, cidade) VALUES ('$rua', '$cidade')";

        if ($conn->query($sql) === TRUE) {
            echo "Dados inseridos com sucesso em 'enderecos'!\n";
        } else {
            echo "\nErro ao cadastrar: " . $conn->error;
        }
    } else {
        echo "Por favor, preencha todos os campos do formulário.\n";
    }
}

$rua = "Rua Teste";
$cidade = "Uberaba";
inserirDadosEnderecos($conn, $rua, $cidade);

function inserirDadosTelefones($conn, $numero, $tipo) {
    if (!empty($numero) && !empty($tipo)) {
        $sql = "INSERT INTO telefones (numero, tipo) VALUES ('$numero', '$tipo')";

        if ($conn->query($sql) === TRUE) {
            echo "Dados inseridos com sucesso em 'telefones'!\n";
        } else {
            echo "\nErro ao cadastrar: " . $conn->error;
        }
    } else {
        echo "Por favor, preencha todos os campos do formulário.\n";
    }
}

$numero = "555555";
$tipo = "Celular";
inserirDadosTelefones($conn, $numero, $tipo);

function inserirDadosPedidos($conn, $descricao, $valor) {
    if (!empty($descricao) && !empty($valor)) {
        $sql = "INSERT INTO pedidos (descricao, valor) VALUES ('$descricao', $valor)";

        if ($conn->query($sql) === TRUE) {
            echo "Dados inseridos com sucesso em 'pedidos'!\n";
        } else {
            echo "\nErro ao cadastrar: " . $conn->error;
        }
    } else {
        echo "Por favor, preencha todos os campos do formulário.\n";
    }
}

$descricao = "Teste";
$valor = 50;
inserirDadosPedidos($conn, $descricao, $valor);

// Exercício 2

function getDetalhesCompras($conn, $idPessoa) {
    $sql = "SELECT p.*, e.rua, e.cidade, t.numero, t.tipo
            FROM pessoas p
            LEFT JOIN enderecos e ON p.id = e.id_pessoa
            LEFT JOIN telefones t ON p.id = t.id_pessoa
            LEFT JOIN pedidos pe ON p.id = pe.id_pessoa
            WHERE p.id = $idPessoa";
    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return "\nNenhum resultado encontrado";
    }
}

$idPessoa1 = 1;
$data = getDetalhesCompras($conn, $idPessoa1);

echo "Registros de todas as pessoas: \n";
print_r($data);

// Exercício 3

function atualizarDetalhesPessoa($idPessoa, $novoNome, $novaIdade, $novoEndereco, $novoTelefone) {
    global $conn;
    
    $sql_pessoa = "UPDATE pessoas SET nome = '$novoNome', idade = $novaIdade WHERE id = $idPessoa";
    $sql_endereco = "UPDATE enderecos SET rua = '$novoEndereco' WHERE id_pessoa = $idPessoa";
    $sql_telefone = "UPDATE telefones SET numero = '$novoTelefone' WHERE id_pessoa = $idPessoa";
    
    $conn->query($sql_pessoa);
    $conn->query($sql_endereco);
    $conn->query($sql_telefone);
    
    echo "\nDetalhes da pessoa atualizados com sucesso!\n";
}

// Exercício 4

function excluirPessoaCompleta($idPessoa) {
    global $conn;
    
    $sql_pedidos = "DELETE FROM pedidos WHERE id_pessoa = $idPessoa";
    $sql_telefones = "DELETE FROM telefones WHERE id_pessoa = $idPessoa";
    $sql_endereco = "DELETE FROM enderecos WHERE id_pessoa = $idPessoa";
    $sql_pessoa = "DELETE FROM pessoas WHERE id = $idPessoa";
    
    $conn->query($sql_pedidos);
    $conn->query($sql_telefones);
    $conn->query($sql_endereco);
    $conn->query($sql_pessoa);
    
    echo "\nPessoa excluída com sucesso!\n";
}

?>