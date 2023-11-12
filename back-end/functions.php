<?php
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'cybermoto';

$connect = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

/*Selecionar (buscar) no BD com base no where*/
function buscar($connect, $tabela, $where = 1, $order=""){
    if(!empty($order)){
        $order = "ORDER BY $order";
    }
    
    $query = "SELECT * FROM $tabela WHERE $where $order";
    $executar = mysqli_query($connect, $query);
    $resultado = mysqli_fetch_all($executar, MYSQLI_ASSOC);
    return $resultado;
}

/*Inserir novos containers no BD*/
function inserirContainer($connect){
    if(isset($_POST['cadastrar']) AND !empty($_POST['cliente']) AND !empty($_POST['cic']) AND !empty($_POST['telefone'])){
        $erros = array();
        $cliente = mysqli_real_escape_string($connect, $_POST['cliente']);
        $cic = $_POST['cic'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];

        #Verifica se já existe cic cadastrado
        $queryCic = "SELECT cic FROM cliente WHERE cic = '$cic'";
        $buscaCic = mysqli_query($connect, $queryCic);
        $verifica = mysqli_num_rows($buscaCic);

        if(!empty($verifica)){
            $erros[] = 'O CPF/CNPJ indicado já existe na nossa base de dados.';
        }

        if(empty($erros)){
            $queryNovoCliente = "INSERT INTO cliente (nome, cic, telefone, email) VALUES ('$cliente','$cic','$telefone','$email')";
            $executar = mysqli_query($connect, $queryNovoCliente);
            if($executar) {
                echo "Cliente cadastrado com sucesso! Por gentileza, atualize a página!" . '<a href="clientes.php"><button type="button" class="btn btn-success"><i class="fa-solid fa-rotate-right"></i> Atualizar</button></a>';
            } else {
                echo "Erro ao cadastrar cliente!";
            }
        } else {
            foreach ($erros as $erro) {
                echo "<p>$erro</p>";
            }
        }
    }
}

/* Deletar cliente da base de dados */
function deletar($connect, $tabela, $nome){
    if(!empty($nome)){
        $queryDeletar = "DELETE FROM $tabela WHERE nome = '$nome'";
        $executar = mysqli_query($connect, $queryDeletar);
        if($executar) {
            echo "Cliente excluido com sucesso! Favor atualizar a página.";
            header("Location: clientes.php");
        } else {
            echo "Erro ao excluir o cliente!";
        }
    }
}

/* Atualização da base de dados */
function editarClientes($connect, $id) {
    if(isset($_POST['atualizar']) AND !empty($_POST['cliente']) AND !empty($_POST['cic']) AND !empty($_POST['telefone'])){
        $erros = array();
        $cliente = mysqli_real_escape_string($connect, $_POST['cliente']);
        $cic = $_POST['cic'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $queryCic = "SELECT cic FROM cliente WHERE cic = '$cic'";
        $buscaCic = mysqli_query($connect, $queryCic);
        $verifica = mysqli_num_rows($buscaCic);

        if($cic != $id){
            if(!empty($verifica)){
                $erros[] = 'O CPF/CNPJ indicado já existe na nossa base de dados.';
            }
        }
        
        $queryCic = "SELECT nome FROM cliente WHERE nome = '$id'";
        $buscaCic = mysqli_query($connect, $queryCic);
        $verifica = mysqli_num_rows($buscaCic);
        
        if(empty($verifica)){
            $erros[] = 'O Cliente que você deseja alterar não existe na nossa base de dados.';
        }
        
        if(empty($erros)){
            $queryEditCliente = "UPDATE cliente SET nome = '$cliente', cic = '$cic', telefone = '$telefone', email = '$email' WHERE nome = '$id'";
            $executar = mysqli_query($connect, $queryEditCliente);

            if($executar) {
                echo "Dados do cliente atualizados com sucesso!";
            } else {
                echo "Erro ao atualizar os dados do ciente!";
            }
        } else {
            foreach ($erros as $erro) {
                echo "<p>$erro</p>";
            }
        }
    }
}

//Dinâmica de LOGIN
