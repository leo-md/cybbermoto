<?php session_start();
$seguranca = isset($_SESSION['ativa']) ? TRUE : header("location: login.php");
require_once 'functions.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="assets/bootstrap.min.css">
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
            <h1>Bem vindo, <?php echo $_SESSION['nome']; ?>! Essa é a página inicial do painel de administração.</h1>
        </div>     
    </header>
    <hr>
    <main>
        <div class='amostra'>
            <div class="card" style="width: 18rem;">
            <img src="assets/img/imgClientes.jpg" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Visão dos Clientes</h5>
                    <p class="card-text">Permite o gerenciamento dos cadastros dos seus clientes.</p>
                    <a href="clientes.php" class="btn btn-success">Disponível</a>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
            <img src="assets/img/imgFornecedores.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Visão dos Fornecedores</h5>
                    <p class="card-text">Permite o gerenciamento dos cadastros dos seus fornecedores.</p>
                    <a href="home.php" class="btn btn-warning">Em desenvolvimento</a>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
            <img src="assets/img/imgRelatorios.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Gestão de Relatórios</h5>
                    <p class="card-text">Permite o gerenciamento dos seus relatórios administrativos.</p>
                    <a href="home.php" class="btn btn-warning">Em desenvolvimento</a>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
            <img src="assets/img/imgSuporte.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Página de Suporte</h5>
                    <p class="card-text">Página destinada aos avisos e chamados do Suporte Técnico.</p>
                    <a href="home.php" class="btn btn-warning">Em desenvolvimento</a>
                </div>
            </div>
        </div>
    </main>
    
</body>
</html>

