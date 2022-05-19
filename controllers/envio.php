<?php require_once("../functions/funcoes.php");

if(isset($_POST["btnEnviar"])){
    $nome=$_POST['txtNome'];
    $cep=$_POST['txtCEP'];
    $endereco=$_POST['txtEnd'];
    $bairro=$_POST['txtBairro'];
    $cidade=$_POST['txtCidade'];
    $uf=$_POST['txtUf'];
    $email=$_POST['txtEmail'];
    $fone=$_POST['numTele'];
    
    
    //Definir o conjunto de dados
    $array=["nome"=>"{$nome}",
    "cep"=>"{$cep}",
    "endereço"=>"{$endereco}",
    "bairro"=>"{$bairro}",
    "cidade"=>"{$cidade}",
    "uf"=>"{$uf}",
    "email"=>"{$email}",
    "fone"=>"{$fone}"];

    array_push($_SESSION['lista'], $array);

    echo "Ola " .$nome ." seus dados foram cadastrados com sucesso." ."<br>";
}


if(isset($_POST["btnListar"])){
        if(empty($_SESSION['lista'])){
        $_SESSION['lista'] = [];
        echo "Preencher os dados corretamente." ."<br>";
    }
    else{   
    $exibirdados=listar();
    echo $exibirdados;
    }
}

// // Declaração de variáveis
// $nome=$_POST['txtNome'];
// $cep=$_POST['txtCEP'];
// $endereco=$_POST['txtEnd'];
// $bairro=$_POST['txtBairro'];
// $cidade=$_POST['txtCidade'];
// $uf=$_POST['txtUf'];
// $email=$_POST['txtEmail'];
// $fone=$_POST['numTele'];


// //Definir o conjunto de dados
// $array=["nome"=>"{$nome}",
// "cep"=>"{$cep}",
// "endereço"=>"{$endereco}",
// "bairro"=>"{$bairro}",
// "cidade"=>"{$cidade}",
// "uf"=>"{$uf}",
// "email"=>"{$email}",
// "fone"=>"{$fone}"];

// Verificação e atribuição dos valores das vairáveis
// if (isset ($_POST['txtNome']))  {
//     $fone            = $_POST['numTele'];
//     $cep             = $_POST['txtCEP'];
//     $endereco        = $_POST['txtEnd'];
//     $bairro          = $_POST['txtBairro'];
//     $cidade          = $_POST['txtCidade'];
//     $uf              = $_POST['txtUf'];
//     $email           = $_POST['txtEmail'];

// $exibirdados=listar();
// echo $exibirdados;
// array_push($_SESSION['lista'], $array);


// Variável $body
// $body = "===================================" ."<br>";
// $body = $body . "FALE CONOSCO - TESTE EXIBIÇÃO" ."<br>";
// $body = $body . "===================================" ."<br>";
// $body = $body . "Nome: " .$nome ."<br>";
// $body = $body .  "Data de Nascimento: " .$data ."<br>";
// $body = $body .  "CPF: " .$cpf ."<br>";
// $body = $body .  "CEP: " .$cep ."<br>";
// $body = $body .  "Endereço: " .$endereco ."<br>";
// $body = $body .  "Bairro: " .$bairro ."<br>";
// $body = $body .  "Cidade: " .$cidade ."<br>";
// $body = $body .  "UF: " .$uf ."<br>";
// $body = $body .  "E-mail: " .$email ."<br>";
// $body = $body .  "Telefone: " .$fone ."<br>";
// $body = $body . "===================================" ."<br>";

// Apresentar o valor da variável
// echo $body."<br>";
//Apresentar a função dia_atual
// $dia = dia_atual();
// echo $dia. "<br />";

// $hora = date('H:i:s');
// echo $hora. "<br />";

// if (($hora >= "00:00:00") && ($hora <= "11:59:59")){
//         echo "Bom dia!!";
// }
// elseif (($hora >= "12:00:00") && ($hora <= "17:59:59")){
//     echo "Boa Tarde!!";
// }
// else {
//     echo "Boa noite!!";
// }

// }


// ?>

<a href="../views/contatos.html">Voltar</a>