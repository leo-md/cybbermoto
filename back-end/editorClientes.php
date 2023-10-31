<?php
require_once 'functions.php';
$usuario = "Administrador";
$tabela = "cliente";

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição - Cyber Container</title>
</head>
<body>
    <header>        
        <?php include "layouts/menu.php"?>   
        <div class="topo">
            <?php
            echo "<h1>Olá " . $usuario . ". Você está no página de edição de clientes.";
            ?>
        </div>     
    </header>
    <hr>
    <main>
    <div class="cadastro">
            <form class="formContainer" action="" method="post">
                <fieldset class="formHorizontal">
                    <legend>Atualizar dados do Cliente <?php echo $_GET['id']; ?></legend>
                    <div>
                        <label for="cliente">Cliente:</label>
                        <input id="cliente" type="text" name="cliente" required value="<?php echo $_GET['id']; ?>">
                    </div>
                    <div>
                        <label for="cic">CPF/CNPJ:</label>
                        <input id="cic" type="text" name="cic" required placeholder="Número do CPF/CNPJ">
                    </div>
                    <div>
                        <label for="telefone">Telefone:</label>
                        <input id="telefone" type="text" name="telefone" required placeholder="Número de contato">
                    </div>
                    <div>
                        <label for="email">E-mail:</label>
                        <input id="email" type="text" name="email" required placeholder="E-mail de contato">
                    </div> 
                    <div>
                    <div>
                        <input type="submit" name="atualizar" value="Atualizar" class="btn btn-primary">
                    </div>                
                </fieldset>
            </form>
            <div class="mensagem">
                <?php editarClientes($connect, $_GET['id']); ?>
            </div>
        </div>
    </main>
    <?php include "layouts/footer.php"?>
    
    
</body>
</html>

