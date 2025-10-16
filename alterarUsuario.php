<?php

include("conexao.php");
include("valida.php");

$cpf = $_POST['cpf'];
$nome = $_POST['nome'];
$senha = $_POST['senha'];
$cpfAnterior = $_POST['cpfAnterior'];

$sql = "update usuarios set cpf = ?,
                            senha = ?,
                            nome = ?
                where cpf = ?";
$stmt = $conn->prepare($sql);

if($stmt) {
    $stmt->bind_param("ssss", $cpf, $senha, $nome, $cpfAnterior);
    if($stmt->execute()){
        header("location: cadastroUsuarios.php");
    } else {
        echo "erro ao alterar usuario";
    }
}