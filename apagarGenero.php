<?php
session_start();
include("conexao.php");
include("valida.php");

$genero = $_POST['genero'];

$sql = 'delete from generos where genero = ?';
$stmt = $conn->prepare($sql);

if($stmt) {
    $stmt->bind_param("s", $genero);
    if($stmt->execute()){
        header("location: cadastroGenero.php");
    } else {
        echo "erro ao deletar genêro";
    }
}