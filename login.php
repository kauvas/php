<?php

include("conexao.php");
$cpf=$_POST["cpf"];
$senha=$_POST["senha"];

$sql = "select * from usuarios where cpf = ? and senha = ?";
$stmt = $conn->prepare($sql);

if($stmt) {
    $stmt->bind_param("ss", $cpf, $senha);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0){
        $row = $resultado->fetch_assoc();
        if($row['nome'] != ''){
            session_start();
            $_SESSION["cpf"] = $cpf;
            $_SESSION["senha"] = $senha;
            $_SESSION["nome"] = $row["nome"];

            header("location: principal.php");
        } else {
            die("Senha incorrta");
        }
} else {
    die("nenhum usuario encontrado");
    }
}