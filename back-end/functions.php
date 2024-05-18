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

/*buscar veículos conforme CodCliente*/
function buscarVeiculo($connect, $tabela, $codCliente) {
    $queryVeiculo = "SELECT * FROM $tabela WHERE codCliente = '$codCliente'";
    $buscaVeiculo = mysqli_query($connect, $queryVeiculo);
    $resultado = mysqli_fetch_all($buscaVeiculo, MYSQLI_ASSOC);
    $verifica = mysqli_num_rows($buscaVeiculo);

    if(empty($verifica)){
        echo 'Nenhum veículo cadastrado';
    } else {
        foreach ($resultado as $linha) {
            foreach ($linha as $chave => $valor) {
                if ($chave == 'placa'){
                    echo '
                    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#'. $valor .'" aria-controls="offcanvasExample">
                      ' . $valor . ' <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="'. $valor .'" aria-labelledby="offcanvasExampleLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Placa: '. $valor .'</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div>
                            Marca: '. $linha['marca'].' <br>
                            Modelo: '. $linha['modelo'].' <br>
                            Fabricação / Modelo: '. $linha['anoFabrica'].' / '. $linha['anoModelo'] .' <br>
                            Quilometragem: '. number_format($linha['quilometragem'],0,',','.'). ' <br>' . buscarPeca($connect, 'peca', $valor, $linha['quilometragem']) .                            
                        '</div>
                    </div>
                    </div>';
                }
            }
        }
    }
}

/*buscar peças conforme CodPlaca*/
function buscarPeca($connect, $tabela, $codPlaca, $kmVeiculo) {
    $queryPeca = "SELECT * FROM $tabela WHERE codPlaca = '$codPlaca'";
    $buscaPeca = mysqli_query($connect, $queryPeca);
    $resultado = mysqli_fetch_all($buscaPeca, MYSQLI_ASSOC);
    $verifica = mysqli_num_rows($buscaPeca);

    $output = ''; // Variável para armazenar os resultados das peças

    if(empty($verifica)){
        // Se não houver peças, retornar uma string vazia
    } else {
        $output .= '<div class="offcanvas-body">'; // Iniciando o offcanvas-body para as peças
        foreach ($resultado as $linha) {
            $condicao = 'Erro de avaliação, verificar';
            foreach ($linha as $chave => $valor) {
                if ($chave == 'codPlaca'){
                    $vida_util_restante = $linha['km_ultima_substituicao'] + $linha['vida_util_esperada'] - $kmVeiculo;
                    $depreciacao = round($vida_util_restante / $linha['vida_util_esperada'] * 100);
                    if ($depreciacao < 2){
                        $depreciacao = 2;
                    }
                    $barraProgresso = '
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 138%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
                                        </div>';
                    if ($vida_util_restante == $linha['vida_util_esperada']) {
                        $condicao = 'Novo';
                    } elseif ($vida_util_restante > 0.5 * $linha['vida_util_esperada']) {
                        $condicao = 'Bom';
                    } elseif ($vida_util_restante > 0.1 * $linha['vida_util_esperada'] && $vida_util_restante <= 0.5 * $linha['vida_util_esperada']) {
                        $condicao = 'Revisar';
                    } elseif ($vida_util_restante <= 0.1 * $linha['vida_util_esperada']) {
                        $condicao = 'Desgastado';
                    }
                    if ($depreciacao == 100) {
                        $barraProgresso = '
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: '. $depreciacao .'%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
                        </div>';
                    } elseif ($depreciacao < 100 && $depreciacao >= 50) {
                        $barraProgresso = '
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="width: '. $depreciacao .'%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
                        </div>';
                    } elseif ($depreciacao < 50 && $depreciacao > 10) {
                        $barraProgresso = '
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped bg-warning progress-bar-animated" role="progressbar" style="width: '. $depreciacao .'%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
                        </div>';
                    } elseif ($depreciacao < 10) {
                        $barraProgresso = '
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped bg-danger progress-bar-animated" role="progressbar" style="width: '. $depreciacao .'%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
                        </div>';
                    }

                    if($linha['km_ultima_substituicao'] == 0){
                        $instalacao = 'Original de Fábrica';
                    } else {
                        $instalacao = number_format($linha['km_ultima_substituicao'],0,',','.');
                    }
                    $output .= '
                            <br>
                            Peça: '. $linha['nome'].' <br>
                            Vida útil esperada: '. number_format($linha['vida_util_esperada'],0,',','.').' <br>
                            KM instalação: '. $instalacao .' <br>
                            Estado de conservação: ' . $condicao.' <br>' . $barraProgresso;
                }
            }
        }
        $output .= '</div>'; // Fechando o offcanvas-body para as peças
    }

    return $output; // Retornando os resultados das peças
}
/*Inserir novos clientes no BD*/
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

function login($connect){
    if (isset($_POST['acessar']) AND !empty($_POST['email']) AND !empty($_POST['senha'])) {

        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $senha = sha1($_POST['senha']);
        $query = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha' ";
        $executar = mysqli_query($connect, $query);
        $return = mysqli_fetch_assoc($executar);

        if (!empty($return['email'])) {
            //echo $return['email'];
            session_start();
            $_SESSION['nome'] = $return['nome'];
            $_SESSION['id'] = $return['id'];
            $_SESSION['ativa'] = TRUE;
            header("location: home.php");

        }else{
            echo "Usuário ou senha inválidos!";
        }
    }
}


function logout(){
    session_start();
    session_unset();
    session_destroy();
    header("Location: login.php");
}
