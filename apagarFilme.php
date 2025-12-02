<?php
session_start();
include("conexao.php");
include("valida.php");

$filme = $_POST['filme'];

$sql = 'delete from filmes where filme = ?';
$stmt = $conn->prepare($sql);

if($stmt) {
    $stmt->bind_param("s", $filme);
    if($stmt->execute()){
        header("location: cadastroFilmes.php");
    } else {
        echo "erro ao deletar filme";
    }
}