<?php
// Verificar o dia da semana
// Extraído de: http://www.linhadecodigo.com.br/artigo/3565/trabalhando-com-funcoes-em-php.asp
//Iniciar uma Session
session_start();

//Se a session não existir, será criada
if(empty($_SESSION['lista'])){
    $_SESSION['lista'] = [];    
}

function listar(){
    // echo "Espelho de array - Apresentação didática <br>";
    // echo "======================================";
    // print_r($_SESSION['lista']);
    // echo "<br><br>";

    // $qtderegistros = count($_SESSION['lista']);
    // echo "Quantidade de Registros no Array = " .$qtderegistros;
    // echo "<br><br>";

    // echo "Tabela com dados <br>";
    // echo "======================================";
    // echo "<br>";

    $tabela = "<table border='1'
                <thead>
                    <tr>
                        <th>Nome</th>       <th>Cep</th>
                        <th>Endereço</th>   <th>Bairro</th>
                        <th>Cidade</th>     <th>UF</th>
                        <th>E-Mail</th>     <th>Telefone</th>
                    </tr>
                </thead>
                <tbody>";
    $retorno = $tabela;

    foreach ($_SESSION['lista'] as $linhadoarray){ 
        $retorno .="<tr>";
        foreach ($linhadoarray as $coluna => $conteudodacoluna){
            $retorno .="<td>" .$conteudodacoluna ."</td>";
            }
        $retorno .="</tr>";
    }
    $retorno .= "</tbody></table>";
    
    session_destroy();
    return $retorno;
}

// function dia_atual(){
//     // date_default_timezone_set('America/Sao_Paulo');
//         //↑ Extraído de: https://www.php.net/manual/pt_BR/function.date-default-timezone-get.php
//     $hoje = getdate();
//     return $hoje;
    // print_r($hoje);
    // switch($hoje["wday"]){
    //     case 0:
    //         return "Domingo";
    //         break;    
    //     case 1:
    //         return "Segunda";
    //         break;
    //     case 2:
    //         return "Terça";
    //         break;
    //     case 3:
    //         return "Quarta";
    //         break;
    //     case 4:
    //         return "Quinta";
    //         break;
    //     case 5:
    //         return "Sexta";
    //         break;
    //     case 6:
    //         return "Sábado";
    //         break;
    // }
// }
?>