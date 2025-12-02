<?php
session_start();
include("conexao.php");
include("valida.php");

$genero = $_POST['genero'];
$descricao = $_POST['descricao'];

if (empty($descricao)) {
    $_SESSION['InserirErro'] = "GeneroVazio";
    header("location: cadastroGenero.php");
    return;
}


$sql = "update generos set descricao = ?
                where genero = ?";
$stmt = $conn->prepare($sql);

try {
if($stmt) {
    $stmt->bind_param("ss", $descricao, $genero);
    if($stmt->execute()){
        header("location: cadastroGenero.php");
    } else {
        echo "erro ao alterar genero";
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