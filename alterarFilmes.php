<?php
session_start();
include("conexao.php");
include("valida.php");
include("validacaoBack.php");

$filme = $_POST['filme'];
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

$sql = "update filmes set nome = ?,
                            ano = ?,
                            genero = ?
                where filme = ?";
$stmt = $conn->prepare($sql);

try {
if($stmt) {
    $stmt->bind_param("ssss", $nome, $ano, $genero, $filme);
    if($stmt->execute()){
        header("location: cadastroFilmes.php");
    } else {
        echo "erro ao alterar filme";
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