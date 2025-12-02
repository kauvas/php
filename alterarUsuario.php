<?php
session_start();
include("conexao.php");
include("valida.php");
include("validacaoBack.php");

$cpf = $_POST['cpf'];
$nome = $_POST['nome'];
$senha = $_POST['senha'];
$cpfAnterior = $_POST['cpfAnterior'];

if (!validarCPF($cpf)) {
    $_SESSION['InserirErro'] = "CPF";
    header("location: cadastroUsuarios.php");
    return;
}

if (!validarNome($nome)) {
    $_SESSION['InserirErro'] = "Nome";
    header("location: cadastroUsuarios.php");
    return;
}

if (!validarSenha($senha)) {
    $_SESSION['InserirErro'] = "Senha";
    header("location: cadastroUsuarios.php");
    return;
}

$sql = "update usuarios set cpf = ?,
                            senha = ?,
                            nome = ?
                where cpf = ?";
$stmt = $conn->prepare($sql);
try {
if($stmt) {
    $stmt->bind_param("ssss", $cpf, $senha, $nome, $cpfAnterior);
    if($stmt->execute()){
        $_SESSION['sNome'] = $_POST['nome'];
        header("location: cadastroUsuarios.php");
    } else {
        echo "erro ao alterar usuario";
    }
}
} catch (Exception $e) {
    $code = $e->getCode();
    if ($code == 1062) {
        $_SESSION['InserirErro'] = "Duplicado";
        header("location: cadastroUsuarios.php");
    } else {
        echo "Erro ao alterar usuário: " . $e->getMessage();
    }
}