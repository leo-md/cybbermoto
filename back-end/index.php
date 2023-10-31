<?php
$usuario = "Administrador";
require_once 'functions.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="assets/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME - Cyber Container</title>
</head>
<body>
    <header>        
        <?php include "layouts/menu.php"?>   
        <div class="topo">
            <?php
            echo "<h1>Olá " . $usuario . ". Você está no página inicial.";
            ?>
        </div>     
    </header>
    <hr>
    <main>

    </main>
    <?php include "layouts/footer.php"?>
    
    
</body>
</html>

