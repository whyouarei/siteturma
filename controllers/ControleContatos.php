<?php
//Não apresentar tela com erros
//ini_set('display_errors', '0');
require_once("../database/bdturma88Connect.php");
require_once("../config/SimpleRest.php");

$page_key="";

//criando uma classe usando como referência ao conteudo do simplerest
class ContatosRestHandler extends SimpleRest{
    public function ContatosIncluir(){
        if(isset($_POST["txtNome"])){

            $nome=$_POST['txtNome'];
            $email=$_POST['txtEmail'];
            $fone=$_POST['numFone'];
            $endereco=$_POST['txtEndereco'];
            $bairro=$_POST['txtBairro'];
            $cidade=$_POST['txtCidade'];
            $uf=$_POST['txtUF'];
            $cep=$_POST['txtCEP'];
            
            $query="SELECT codContato from tbcontatos ORDER by codContato desc LIMIT 1";
            $dbcontroller = new bdTurmaConnect();
            $codigo = $dbcontroller->executeQuery($query);


            //Definir instruções SQL
            $query = "INSERT INTO tbContatos (
                                        codContato,
                                        nomedoContato,
                                        enderecoContato,
                                        telefoneContato,
                                        bairro,
                                        cidade,
                                        uf,
                                        cep,
                                        emailContato)
                                VALUES({$codigo},
                                        '{$nome}',
                                        '{$endereco}',
                                        '{$fone}',
                                        '{$bairro}',
                                        '{$cidade}',
                                        '{$uf}',
                                        '{$cep}',
                                        '{$email}')";
        
            //Instanciar a classe BdTurmaConect
            $dbcontroller = new bdTurmaConnect();

            //Chamar o Método
            $rawData = $dbcontroller->executeQuery($query);

            //Verificar se o retorno está "vazio"
            if(empty($rawData)){
            $statusCode = 404;
            $rawData = array('sucesso' => 0);
            }

            else{
            $statusCode = 200;
            $rawData = array('sucesso' => 1);
            }

            $requestContentType = $_POST['HTTP_ACCEPT'];
            $this ->setHttpHeaders($requestContentType, $statusCode);
            $result["RetornoDados"] = $rawData;

            if(strpos($requestContentType,'application/json') !== false){
                $response = $this->encodeJson($result);
                echo $response;
            }
        }
    }

    public function ContatosConsultar(){
        if(isset($_POST["txtNome"])){
            $nome=$_POST['txtNome'];
            
            $query = "CALL spConsultarContatos(:pNome)";
            $array = array(":pNome"=>"{$nome}");
            
            //Instanciar a classe BdTurmaConect
            $dbcontroller = new bdTurmaConnect();

            //Chamar o Método
            $rawData = $dbcontroller->executeProcedure($query,$array);

            //Verificar se o retorno está "vazio"
            if(empty($rawData)){
            $statusCode = 404;
            $rawData = array('sucesso' => 0);
            }

            else{
            $statusCode = 200;
            }

            $requestContentType = $_POST['HTTP_ACCEPT'];
            $this ->setHttpHeaders($requestContentType, $statusCode);
            $result["RetornoDados"] = $rawData;

            if(strpos($requestContentType,'application/json') !== false){
                $response = $this->encodeJson($result);
                echo $response;
            }
        }
    }


    public function encodeJson($responseData){
        $jsonResponse = json_encode($responseData);
        return $jsonResponse;
    }

}

if(isset($_GET["page_key"])){
    $page_key = $_GET["page_key"];
}

else{

    if(isset($_POST["page_key"])){
    $page_key = $_POST["page_key"];
    }
}

//Direto na URL o método é GET



switch($page_key){

    case "Consultar":
        $contatos = new ContatosRestHandler();
        $contatos -> ContatosConsultar();
        break;

    case "Incluir":
        $contatos = new ContatosRestHandler();
        $contatos -> ContatosIncluir();
        break;
}

?>