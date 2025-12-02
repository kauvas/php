<?php
session_start();
?>
<html>
<head>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.forms['inserirForm'];
            form.addEventListener('submit', function(e) {
                const descricao = form.descricao.value.trim();

                if (descricao === "") {
                    alert('Descrição vazia.');
                    e.preventDefault();
                    return;
                }
            });
        });
    </script>
        <?php
        if ($_SESSION['InserirErro'] == "GeneroVazio") {
            ?>
            <script>
                alert("Descrição vazia.");
            </script>
            <?php
            $_SESSION['InserirErro'] = false;
        }
        if ($_SESSION['InserirErro'] == "Duplicado") {
            ?>
            <script>
                alert("Duplicado.");
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
    <h2>Cadastrar Genero</h2>
    <form method="POST" action="inserirGenero.php">
        Descrição: <input type="text" name="descricao"><br>
        <input type="submit" value="Inserir">
    </form>
    <br><br><br>
    <?php

    include("conexao.php");

    $sql = "select genero,descricao from generos";
    if(!$resultado = $conn->query($sql)){
        die("erro");
    }
    ?>
        <table>
        <tr>
            <td>DESCRIÇÃO</td>
            <td>ALTERAR</td>
            <td>EXCLUIR</td>
        </tr>
    <?php
        while($row = $resultado->fetch_assoc()){
            ?>
            <tr>
                <form method="post" action="alterarGenero.php">
                    <input type="hidden" name="genero" value="<?=$row["genero"];?>">
                    <td><input type ="text" name="descricao" value="<?=$row['descricao'];?>"></td>
                    <td><input type ="submit" value ="alterar"></td>
                </form>
                <form method ="post" action="apagarGenero.php">
                    <input type ="hidden" name ="genero" value="<?=$row['genero'];?>">
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