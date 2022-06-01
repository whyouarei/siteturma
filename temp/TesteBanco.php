<?php 

$conexao="";
$host="localhost";
$user="root";
$password="";
$database="bdturma88";

function connectDB() {
    $GLOBALS['conexao']=mysqli_connect($GLOBALS['host'],$GLOBALS['user'],$GLOBALS['password'],$GLOBALS['database']);

    if(!$GLOBALS['conexao']) {
        printf("Falha de Conexão: %s\n", mysqli_connect_error());
        exit();
    }
    else{
        printf("Sucesso, sua conexão com o MySQL foi estabelecida.");
    }
}

connectDB();
echo "<br>";
?>

<!-- // $host = "localhost";
// $user = "root";
// $password = "";
// $database = "bdxxx";

// $link = mysqli_connect($host,$user,$password,$database);

// if (!$link) {
// echo"Erro: Não foi possível connectar ao MySQL."  .PHP_EOL ."<br>";
// echo"Número do erro: " . mysqli_connect_errno() .PHP_EOL ."<br>";
// echo"Possível erro: " . mysqli_connect_error() .PHP_EOL ."<br>";

// exit;
// }
// echo "Sucesso: A conexão com o MySQL foi estabelecida! "  .PHP_EOL ."<br>";
// echo "Informação de seu host: " . mysqli_get_host_info($link) .PHP_EOL;
// mysqli_close($link); -->