<?php
session_start();
include("conexao.php");
include("valida.php");

$descricao = $_POST['descricao'];

if (empty($descricao)) {
    $_SESSION['InserirErro'] = "GeneroVazio";
    header("location: cadastroGenero.php");
    return;
}

$sql = 'insert into generos (descricao) values(?)';
$stmt = $conn->prepare($sql);

try {
if($stmt) {
    $stmt->bind_param("s", $descricao);
    if($stmt->execute()){
        header("location: cadastroGenero.php");
    } else {
        echo "erro ao inserir genêro";
    }
}
} catch (Exception $e) {
    $code = $e->getCode();
    if ($code == 1062) {
        $_SESSION['InserirErro'] = "Duplicado";
        header("location: cadastroGenero.php");
    } else {
        echo "Erro ao alterar Genêro: " . $e->getMessage();
    }
}