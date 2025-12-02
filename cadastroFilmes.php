<?php
session_start();
?>
<html>
<head>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.forms['inserirForm'];
            form.addEventListener('submit', function(e) {
                const nome = form.nome.value.trim();
                const ano = form.ano.value.trim();

                if (nome === "") {
                    alert('Nome vazio.');
                    e.preventDefault();
                    return;
                }

                if (!/^\d{4}$/.test(ano)) {
                    alert('Ano deve conter exatamente 4 dígitos numéricos.');
                    e.preventDefault();
                    return;
                }
            });
        });
    </script>
    <?php
        if ($_SESSION['InserirErro'] == "NomeFilme") {
            ?>
            <script>
                alert("Nome vazio.");
            </script>
            <?php
            $_SESSION['InserirErro'] = false;
        }
        if ($_SESSION['InserirErro'] == "Ano") {
            ?>
            <script>
                alert("Ano inválido.");
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
<?php
include("conexao.php");
?>

<div style="background-color: #ddd; min-height:400px; width: 1000px; float:left">
    <h2>Cadastrar Filme</h2>
    <form method="POST" action="inserirFilmes.php">
        Nome: <input type="text" name="nome"><br>
        Ano: <input type="text" name="ano"><br>
        Genêro: <select name="genero">
            <?php
            $sql = "select * from generos";
            if(!$resultado = $conn->query($sql)){
                die("erro ao buscar generos");
            }
            while($row = $resultado->fetch_assoc()){
                ?>
                <option value="<?=$row['genero']?>"><?=$row['descricao'];?></option>
                <?php
            }
            ?>
        </select><br>
        <input type="submit" value="Inserir">
    </form>
    <br><br><br>
    <?php

    

    $sql = "select f.filme, f.nome, f.ano, f.genero, g.descricao
                from filmes f
                inner join generos g on (g.genero=f.genero)";
    if(!$resultado = $conn->query($sql)){
        die("erro");
    }
    ?>
        <table>
        <tr>
            <td>NOME</td>
            <td>ANO</td>
            <td>GENERO</td>
            <td>ALTERAR</td>
            <td>EXCLUIR</td>
        </tr>
    <?php
        while($row = $resultado->fetch_assoc()){
            ?>
            <tr>
                <form method="post" action="alterarFilmes.php">
                    <input type="hidden" name="filme" value="<?=$row["filme"];?>">
                    <td><input type ="text" name="nome" value="<?=$row['nome'];?>"></td>
                    <td><input type ="text" name="ano" value="<?=$row['ano'];?>"></td>
                    <td><select name="genero">
                        <option value="">Selecione um genêro</option>
                        <?php
                        $sqlGeneros = "select * from generos";
                        if(!$resultadoGeneros = $conn->query($sqlGeneros)){
                            die("erro ao buscar genêros");
                        }
                        while($rowGeneros = $resultadoGeneros->fetch_assoc()){
                            ?>
                            <option value="<?=$rowGeneros['genero'];?>"<?=($rowGeneros['genero']==$row['genero'])?'selected':'';?>><?=$rowGeneros['descricao']?></option>
                            <?php
                        }
                        ?></td>
                        <td><input type="submit" value="alterar"></td>
                    </select>
                </form>
                
                <form method ="post" action="apagarFilme.php">
                    <input type ="hidden" name ="filme" value="<?=$row['filme'];?>">
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