<?php
session_start();
include("conexao.php");
include("valida.php");
include("validacaoBack.php");

$cpf = $_POST['cpf'];
$nome = $_POST['nome'];
$senha = $_POST['senha'];

// Validações
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

try {
$sql = 'insert into usuarios (cpf,nome,senha) values(?,?,?)';
$stmt = $conn->prepare($sql);

if($stmt) {
    $stmt->bind_param("sss", $cpf, $nome, $senha);
    if($stmt->execute()){
        header("location: cadastroUsuarios.php");
    } else {
        echo "erro ao inserir usuario";
    }
}
} catch (Exception $e) {
    $code = $e->getCode();
    if ($code == 1062) {
        $_SESSION['InserirErro'] = "Duplicado";
        header("location: cadastroUsuarios.php");
    } else {
        echo "Erro ao inserir usuário: " . $e->getMessage();
    }
}