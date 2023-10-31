<?php
require_once 'functions.php';
$usuario = "Administrador";
$tabela = "cliente";
$order = "id DESC";
$clientes = buscar($connect, $tabela, 1, $order);
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
    <title>CLIENTES - CyberMoto</title>
</head>
<body>
    <header>        
        <?php include "layouts/menu.php"?>   
        <div class="topo">
            <div>
                <?php
                echo "<h1>Olá " . $usuario . ". Você está no página de gerenciamento de clientes.";
                ?>
            </div>
        </div>     
    </header>
    <hr>
  <main>
    <div class="mensagem">
        <?php inserirContainer($connect); ?>
        <?php
            if(isset($_GET['nome'])) { ?>
                <p>Tem certeza que deseja deletar o cliente <?php echo $_GET['nome']; ?>?</p>
                <form action="" method="post">
                    <input type="hidden" name="nome" value="<?php echo $_GET['nome']; ?>">
                    <a href="clientes.php"><button type="button" class="btn btn-warning">Cancelar</button>                     </a>
                    <input type="submit" name="deletar" value="Deletar" class="btn btn-danger">
                </form>
            <?php } ?>
        <?php
            if(isset($_POST['deletar'])){
                deletar($connect, $tabela, $_POST['nome']);
            }                   
            
        ?>
    </div>
    <div class="cadastro">
      <form class="formContainer" action="" method="post">
          <fieldset class="formHorizontal">
              <legend> Cadastrar Novo Cliente </legend>
              <div>
                  <label for="cliente">Cliente:</label>
                  <input id="cliente" type="text" name="cliente" required placeholder="Nome do cliente">
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
                  <input type="submit" name="cadastrar" value=" + Cadastrar " class="btn btn-primary">
              </div>                
          </fieldset>
      </form>
    </div>

    <div class="accordion accordion-flush" id="accordionFlushExample">
    <?php foreach ($clientes as $container):?>
      <div class="accordion-item">
            <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php echo $container['id']?>" aria-expanded="false" aria-controls="flush-collapse<?php echo $container['id']?>">
              <?php echo $container['nome']?>
            </button>
            </h2>
            <div id="flush-collapse<?php echo $container['id']?>" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body"><ol class="list-group list-group-numbered">
  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      <div class="fw-bold">CPF/CNPJ</div>
      <?php echo $container['cic']?>
    </div>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      <div class="fw-bold">Telefone</div>
      <?php echo $container['telefone']?>
    </div>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      <div class="fw-bold">E-mail</div>
      <?php echo $container['email']?>
    </div>
  </li>
    <div class="ms-2 me-auto f-acoes">
      <a href="editorclientes.php?id=<?php echo $container['nome'];?>">
        <button type="button" class="btn btn-success"><i class="fa-solid fa-file-pen"></i> Alterar</button>
      </a> 
      <a href="clientes.php?nome=<?php echo $container['nome'];?>">
        <button type="button" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Deletar</button>
      </a> 
        
    </div>
</ol> 
            </div>
        </div>
        <?php endforeach ?>    
    </div>
        
        
    </main>
    <?php include "layouts/footer.php"?>
    
    <script src="assets/bootstrap.min.js"></script>
</body>

</html>

