<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "usuarios";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Query para criar a tabela
$sql = "CREATE TABLE IF NOT EXISTS pessoas (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    idade INT(3) NOT NULL,
    sexo VARCHAR(1)
)";
 
// Executar a query
if ($conn->query($sql) === TRUE) {
    echo "Tabela 'pessoas' criada com sucesso\n";
} else {
    echo "Erro ao criar tabela: " . $conn->error;
}

function getAllPessoas($conn) {
    $sql = "SELECT * FROM pessoas";
    $result = $conn->query($sql);
 
    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return "Nenhum resultado encontrado";
    }
}

function getTotalPessoas($conn) {
    $sql = "SELECT COUNT(*) AS total_pessoas FROM pessoas";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return "Total de pessoas: " . $row["total_pessoas"];
    } else {
        return "Nenhum resultado encontrado";
    }
}

function getPessoaId($conn, $id) {
    $sql = "SELECT * FROM pessoas WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

function updatePessoaId($conn, $id, $nome, $idade, $sexo) {
    $sql = "UPDATE pessoas SET nome='$nome', idade='$idade', sexo='$sexo' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        return "Registro atualizado com sucesso!";
    } else {
        return "Erro ao atualizar registro: " . $conn->error;
    }
}

$nome = "Jonatas";
$idade = 16;
$sexo = "M";

if (!empty($nome) && !empty($idade) && !empty($sexo)) {
    $sql = "INSERT INTO pessoas (nome, idade, sexo) VALUES ('$nome', '$idade', '$sexo')";

    if ($conn->query($sql) === TRUE) {
        echo "Cadastro realizado com sucesso!\n";
    } else {
        echo "Erro ao cadastrar: " . $conn->error;
    }
} else {
    echo "Por favor, preencha todos os campos do formulário.\n";
}

$pessoa_id = 1;
$update_id = 2;
$novo_nome = "teste";
$nova_idade = 1;
$novo_sexo = "T";

$atualizar_pessoa = updatePessoaId($conn, $update_id, $novo_nome, $nova_idade, $novo_sexo);
$buscar_id = getPessoaId($conn, $pessoa_id);
$data = getAllPessoas($conn);
$total = getTotalPessoas($conn);

echo "Registros de todas as pessoas: \n";
print_r($data);
echo "\nTotal de pessoas: " . $total . "\n";
echo "Buscar pessoa por ID: \n";
print_r($buscar_id);
echo "\nAtualização da pessoa: \n";
echo $atualizar_pessoa;

$conn->close();
?>
