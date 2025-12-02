<?php
session_start();
include("conexao.php");
include("valida.php");
include("validacaoBack.php");

$nome = $_POST['nome'];
$ano = $_POST['ano'];
$genero = $_POST['genero'];

// Validações
if (!validarNome($nome)) {
    $_SESSION['InserirErro'] = "NomeFilme";
    header("location: cadastroFilmes.php");
    return;
}

if (!validarAno($ano)) {
    $_SESSION['InserirErro'] = "Ano";
    header("location: cadastroFilmes.php");
    return;
}

$sql = 'insert into filmes (nome, ano, genero) values(?, ?, ?)';
$stmt = $conn->prepare($sql);

try {
if($stmt) {
    $stmt->bind_param("sss", $nome, $ano, $genero);
    if($stmt->execute()){
        header("location: cadastroFilmes.php");
    } else {
        echo "erro ao inserir filme";
    }
}
} catch (Exception $e) {
    $code = $e->getCode();
    if ($code == 1062) {
        $_SESSION['InserirErro'] = "Duplicado";
        header("location: cadastroFilmes.php");
    } else {
        echo "Erro ao alterar Genêro: " . $e->getMessage();
    }
}