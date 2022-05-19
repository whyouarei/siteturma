<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste Array</title>
</head>

<body>
    <?php
    echo "Teste de Array <br>";

    //Atribuição de Array (Coleção de Dados) - Vetor
    $array_numeros = array(5, 10, 15, 20, 25);

    //Apresentar os dados
    print_r($array_numeros);

    echo "<br><br>";

    //Verificar a quantidade de itens
    $qtdeitens = count($array_numeros);

    echo "Quantidade de itens da coleção: " . $qtdeitens;

    //Apresentar os dados utilizando estrutura de repetição (For)
    //Para i=0, sendo menor que $qtdeitens acrescenta mais 1 ($i++)
    for ($i = 0; $i < $qtdeitens; $i++) {
        echo "<br><br>";
        echo "Índice: " . $i . "<br>" . "Valor: " . $array_numeros[$i];
    }
    echo "<br><br>";
//*************************************************************************************************************************************************************************/
    //Foreach
    //Para cada elemento na coleção de dados sendo $i, imprima o valor de $i e repita até finalizar a quantidade de elementos.
    foreach ($array_numeros as $i) {
        echo $i . "<br>";
    }
    echo "<br><br>";
//*************************************************************************************************************************************************************************/
    //Criando uma array e incluindo um valor posteriormente - Mais de uma dimensão
    $salarios = array();
    $salarios["Claudia"] = 1000;
    $salarios["João"] = 7000;
    $salarios["Luiza"] = 12000;


    foreach ($salarios as $key_arr => $var_arr) {
        echo $key_arr . " = " . $var_arr  . "<br>";
    }
//*************************************************************************************************************************************************************************/
    //Array multidimensional
    $produtos = array(
        array("Maçã", 20, 10),
        array("Banana", 10, 15),
        array("Laranja", 15, 7),
        array("Pera", 20, 5)
    );
//*************************************************************************************************************************************************************************/
    //Forception
    for ($linha = 0; $linha < 4; $linha++) {
        echo "<p><b>Linha Número: " . $linha . "</b></p>";
        echo "<ul>";
        for ($coluna = 0; $coluna < 3; $coluna++) {
            echo "<li>" . $produtos[$linha][$coluna] . "</li>";
        }
        echo "</ul>";
    }
//*************************************************************************************************************************************************************************/
    $idade = array("Marcos" => "35", "Suzana" => "37", "Joel" => "43");

    session_start();

    //Se a session não existir, será criada
    if (empty($_SESSION['lista'])) {
        $_SESSION['lista'] = [];
    }

    array_push($_SESSION['lista'], $idade);

    $tabela = "<table border='1'>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Idade</th>
                            </tr>
                        </thead>
                        <tbody>";

    $retorno = $tabela;

    // print_r($_SESSION['lista']);

    foreach ($_SESSION['lista'] as $linhadoarray) {
        foreach ($linhadoarray as $key_nome => $var_idade) {
            $retorno .= "<tr>";
            $retorno .= "<td>" . $key_nome . "</td>";
            $retorno .= "<td>" . $var_idade . "</td>";
            $retorno .= "</tr>";
        }
    }
//*************************************************************************************************************************************************************************/
    //While
    $retorno .= "<tr>";
    $retorno .= "<td> ***** </td>";
    $retorno .= "<td> ***** </td>";
    $retorno .= "</tr>";

    //Valores da variável idade sendo encaminhadas para a variável indice e classificando em ordem crescente com o rsort
    $indice = array_keys($idade);
    rsort($indice);

    //Enquanto o $indice NÃO estiver vazio (!=Simbolo de negação), execute:
    while (!empty($indice)){
        $retorno .="<tr>";
        $nomecoluna = array_pop($indice);
        $retorno .= "<td>" . $nomecoluna . "</td>";
        $retorno .= "<td>" . $idade[$nomecoluna] . "</td>";
        $retorno .="</tr>";
    }
//*************************************************************************************************************************************************************************/
    //do
    $retorno .= "<tr>";
    $retorno .= "<td> ***** </td>";
    $retorno .= "<td> ***** </td>";
    $retorno .= "</tr>";

    $indice = array_keys($idade);


    do{
        $retorno .="<tr>";
        $nomecoluna = array_pop($indice);
        $retorno .= "<td>" . $nomecoluna . "</td>";
        $retorno .= "<td>" . $idade[$nomecoluna] . "</td>";
        $retorno .="</tr>";
    }

    while (!empty($indice));
//*************************************************************************************************************************************************************************/

    //
    $retorno .= "<tr>";
    $retorno .= "<td> ***** </td>";
    $retorno .= "<td> ***** </td>";
    $retorno .= "</tr>";

    foreach ($idade as $coluna=>$conteudocoluna){
        $retorno .= "<tr>";
        $retorno .= "<td>" . $coluna . "</td>";
        $retorno .= "<td>" . $conteudocoluna . "</td>";
        $retorno .= "</tr>";
    }
    $retorno .= "</tbody></table>";
    echo $retorno;
    session_destroy();
    ?>

</body>

</html>