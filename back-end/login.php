<?php require_once "functions.php"; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acesso - Cyber Moto</title>
</head>
<body>
    <div class="containerLogin">
        <form class="formLogin" action="" method="post">
            <fieldset>
                <legend>Login</legend>
                <label for="email">E-mail:</label>
                <input id='email' type="email" name="email" placeholder="Informe seu e-mail" required>
                <label for="senha">Senha:</label>
                <input id='senha'type="password" name="senha" placeholder="Insira sua senha" required>
                <input type="submit" name="acessar" value="Acessar" class="btn btn-primary">
            </fieldset>
        </form>
        <div class="mensagem" id="msgLogin">
            <?php
            if (isset($_POST['acessar'])) {
                login($connect);
            }
            ?>
            <div><a  href='http://localhost/cybermoto-main/'><button type="button" class="btn btn-success"><i class="bi bi-arrow-return-left"></i> Retornar </button></a></div>
        </div>
        
    </div>
    
</body>
<?php include "layouts/footer.php"?>
    
    <script src="assets/bootstrap.min.js"></script>
</html>

