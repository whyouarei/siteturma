<?php
//Não apresentar tela com erros
//ini_set('display_errors', '0');
require_once("../database/bdturma88Connect.php");
require_once("../config/SimpleRest.php");

$page_key="";

//criando uma classe usando como referência ao conteudo do simplerest
class UsuariosRestHandler extends SimpleRest{
    public function UsuariosIncluir(){
        if(isset($_POST["txtNomeUsuario"])){

            $nome=$_POST['txtNomeUsuario'];
            $email=$_POST['txtEmailUsuario'];
            $senha=$_POST['txtSenhaUsuario'];

            $query = "CALL spInserirUsuarios(:pusuario,:pemail,:psenha)";
            $array = array(":pusuario"=>"{$nome}",":pemail"=>"{$email}",":psenha"=>"{$senha}");

            
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

    public function UsuariosConsultar(){
        if(isset($_POST["txtNomeUsuario"])){
            $nome=$_POST['txtNomeUsuario'];
            
            $query = "CALL spConsultarUsuarios(:pUsers)";
            $array = array(":pUsers"=>"{$nome}");
            
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
        $usuarios = new UsuariosRestHandler();
        $usuarios -> UsuariosConsultar();
        break;

    case "Incluir":
        $usuarios = new UsuariosRestHandler();
        $usuarios -> usuariosIncluir();
        break;
}

?>