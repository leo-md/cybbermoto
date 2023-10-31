<?php
require_once 'functions.php';
$usuario = "Administrador";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4c971d825c.js" crossorigin="anonymous"></script>
    <title>FORNECEDORES - CyberMoto</title>
</head>
<body>
    <header>        
        <?php include "layouts/menu.php"?>   
        <div class="topo">
            <div>
                <?php
                echo "<h1>Olá " . $usuario . ". Você está no página de gerenciamento de fornecedores.";
                ?>
            </div>
            <div>
            <abbr title="Novo Fornecedor"><button type="button" class="btn btn-primary"><i class="fa-solid fa-circle-plus"></i> Adicionar</button></abbr>
            </div>
        </div>     
    </header>
    <hr>
    <main>
    <div class="accordion accordion-flush" id="accordionFlushExample">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse4" aria-expanded="false" aria-controls="flush-collapse4">
                Auto Peças Azenha
                </button>
            </h2>
            <div id="flush-collapse4" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">Informações detalhadas do fornecedor, recuperadas via <code>PHP</code> junto ao banco de dados de forma dinâmica.
                <button type="button" class="btn btn-success"><i class="fa-solid fa-file-pen"></i> Alterar</button> - <button type="button" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Deletar</button>
            </div>
                
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                CDV - Cruzeiro do Sul
            </button>
            </h2>
            <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body"><ol class="list-group list-group-numbered">
  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      <div class="fw-bold">Endereço</div>
      Rua das Tulipas n° 83, Bairro Cruzeiro do Sul, Guaiba - RS
    </div>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      <div class="fw-bold">Telefone</div>
      51-999.999.999
    </div>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      <div class="fw-bold">E-mail</div>
      comercial@cdv.com.br
    </div>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      <div class="fw-bold">Site</div>
      <a href='#'>www.cdv.com.br</a>
    </div>
  </li>
    <div class="ms-2 me-auto f-acoes">
      <button type="button" class="btn btn-success"><i class="fa-solid fa-file-pen"></i> Alterar</button>  <button type="button" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Deletar</button>
    </div>
</ol> 
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                Auto Elétrica Gaúcha
            </button>
            </h2>
            <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">Informações detalhadas do fornecedor, recuperadas via <code>PHP</code> junto ao banco de dados de forma dinâmica. <button>Alterar</button> - <button>Deletar</button></div>
            </div>
        </div>
    </div>
        

        
        
    </main>
    <?php include "layouts/footer.php"?>
    
    <script src="assets/bootstrap.min.js"></script>
</body>

</html>

