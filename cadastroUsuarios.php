<?php
session_start();
?>
<html>
<head>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.forms['inserirForm'];
            form.addEventListener('submit', function(e) {
                const cpf = form.cpf.value.trim();
                const senha = form.senha.value;

                // Validação do CPF: exatamente 11 dígitos numéricos
                if (!/^\d{11}$/.test(cpf)) {
                    alert('CPF deve conter exatamente 11 dígitos numéricos.');
                    e.preventDefault();
                    return;
                }

                // Validação da senha: minúscula, maiúscula e caractere especial
                const hasLower = /[a-z]/.test(senha);
                const hasUpper = /[A-Z]/.test(senha);
                const hasSpecial = /[^a-zA-Z0-9]/.test(senha);

                if (!hasLower || !hasUpper || !hasSpecial) {
                    alert('A senha deve conter pelo menos uma letra minúscula, uma maiúscula e um caractere especial.');
                    e.preventDefault();
                    return;
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.forms['alterarForm'];
            form.addEventListener('submit', function(e) {
                const cpf = form.cpf.value.trim();
                const senha = form.senha.value;

                // Validação do CPF: exatamente 11 dígitos numéricos
                if (!/^\d{11}$/.test(cpf)) {
                    alert('CPF deve conter exatamente 11 dígitos numéricos.');
                    e.preventDefault();
                    return;
                }

                // Validação da senha: minúscula, maiúscula e caractere especial
                const hasLower = /[a-z]/.test(senha);
                const hasUpper = /[A-Z]/.test(senha);
                const hasSpecial = /[^a-zA-Z0-9]/.test(senha);

                if (!hasLower || !hasUpper || !hasSpecial) {
                    alert('A senha deve conter pelo menos uma letra minúscula, uma maiúscula e um caractere especial.');
                    e.preventDefault();
                    return;
                }
            });
        });
        </script>
        <?php
        if ($_SESSION['InserirErro'] == "CPF") {
            ?>
            <script>
                alert("CPF inválido.");
            </script>
            <?php
            $_SESSION['InserirErro'] = false;
        }
        if ($_SESSION['InserirErro'] == "Nome") {
            ?>
            <script>
                alert("Nome inválido.");
            </script>
            <?php
            $_SESSION['InserirErro'] = false;
        }
        if ($_SESSION['InserirErro'] == "Senha") {
            ?>
            <script>
                alert("Senha inválida.");
            </script>
            <?php
            $_SESSION['InserirErro'] = false;
        }
        if ($_SESSION['InserirErro'] == "Duplicado") {
            ?>
            <script>
                alert("CPF já cadastrado.");
            </script>
            <?php
            $_SESSION['InserirErro'] = false;
        }
        ?>
        
</head>
<body>
<div style="width: 1200px; margin: 0 auto;">
    <div style="min-height: 100px; width:100%; background-color: #1faa36dd">
    <div style="width:50%; float:left">
    <span style="padding-left: 10px">Olá <?=$_SESSION['nome']?></span>
    </div>
    
    <div style="width:50%; float:left; text-align:right;">
    <span style="background-color:blue; margin-right:10px;"> <a href="sair.php"><font color="black">Sair</font></a></span>
    </div>

</div>
<div id="menu" style="width: 200px; background-color: #f4f4f4; min-height:40px; float:left;">
    <h2>Menu</h2>
    <p><a href="cadastroUsuarios.php"><font color="black">Cadastrar Usuários</font></a></p>
    <p><a href="cadastroGenero.php"><font color="black">Cadastrar Generos</font></a></p>
    <p><a href="cadastroFilmes.php"><font color="black">Cadastrar Filmes</font></a></p>
</div>

<div style="background-color: #ddd; min-height:400px; width: 1000px; float:left">
    <h2>Cadastrar Usuários</h2>
    <form name="inserirForm" method="post" action="inserirUsuario.php">
        CPF: <input type="text" name="cpf"><br>
        NOME: <input type="text" name="nome"><br>
        SENHA: <input type="text" name="senha"><br>
        <input type="submit" value="Inserir">
    </form>
    <br><br><br>
    <?php

    include("conexao.php");

    $sql = "select nome,cpf,senha from usuarios";
    if(!$resultado = $conn->query($sql)){
        die("erro");
    }
    ?>
        <table>
        <tr>
            <td>NOME</td>
            <td>CPF</td>
            <td>SENHA</td>
            <td>ALTERAR</td>
            <td>EXCLUIR</td>
        </tr>
    <?php
        while($row = $resultado->fetch_assoc()){
            ?>
            <tr>
                <form name="alterarForm" method="post" action="alterarUsuario.php">
                    <input type="hidden" name="cpfAnterior" value="<?=$row["cpf"];?>">
                    <td><input type ="text" name="nome" value="<?=$row['nome'];?>"></td>
                    <td><input type ="text" name="cpf" value="<?=$row['cpf'];?>"></td>
                    <td><input type ="text" name="senha" value="<?=$row['senha'];?>"></td>
                    <td><input type ="submit" value ="alterar"></td>
                </form>
                <form method ="post" action="apagarUsuario.php">
                    <input type ="hidden" name ="cpf" value="<?=$row['cpf'];?>">
                <td><input type="submit" value="Apagar"></td>
                </form>
            </tr>
            <?php
        }
    ?>
    </table>
</div>
    </div>
    </body>