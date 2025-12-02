<?php
session_start();
?>
<html>
<head>
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
    <h2>Conteudo</h2>
    <p>aquii vai o conteudo principal</p>
</div>

</body>
</html>