<?php // Condição que verifica se há um valor no parâmetro

if(isset($_GET["cor"])) {

    //Declaração de variáveis.
    $nome;
    $idade;

    //Variável com um parâmetro (ESSENCIAL QUE FIQUE NO TOPO DO CÓDIGO)
    $cor=$_GET["cor"];

    // Atribuição de valor para uma variável ou Popular a variável.
    // Sinal de igual (=) significa RECEBE. Portanto: variável nome recebe valor Yuri.
    $nome='Yuri';

    // Apresentação do valor atribuído à variável
    echo $nome ."<br>";

    //Concatenação
    echo "Olá, ".$nome ."<br>";
    ?><br /><?php $idade=1;
    echo "Idade ".$idade ."<br>";


    $a=$idade+1;
    $b="2";
    $c=$b+$a;

    echo "A ".$a ."<br>";
    echo "B ".$b ."<br>";
    echo "C ".$c ."<br>";
    echo "A cor escolhida foi ".$cor;
}

?>