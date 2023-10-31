<?php
$usuario = "Administrador";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="assets/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acesso - Cyber Container</title>
</head>
<body>
    <div class="containerLogin">
        <form class="formLogin" action="" method="post">
            <fieldset>
                <legend>Painel de Login</legend>
                <input type="e-mail" nome="email" placeholder="Informe seu e-mail" requered>
                <input type="password" nome="senha" placeholder="Insira sua senha" requered>
                <a href="index.php"><input type="submit" nome="acessar" value="Acessar" class="botaoPadrao"></a>
            </fieldset>
        </form>
    </div>
    <?php include "layouts/footer.php"?>
</body>
</html>

