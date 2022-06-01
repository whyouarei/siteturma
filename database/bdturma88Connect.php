<?php 
//Não apresentar tela de erros
//ini_set('display_errors','0');

//Criação de uma classe bdturmConnect
class bdTurmaConnect {

    //Declaração de variáveis públicas apenas dentro da classe bdTurmaConnect
    public $host="localhost";
    public $user="root";
    public $password="";
    public $database="bdturma88";

    // Função para conectar banco de dados
    function connectDB() {

        //As declarações try...catch marcam um bloco de declarações para testar (try),  e especifica uma resposta, caso uma exceção seja lançada. (tratamento de exceções)
        try {
            //$this se refencia a classe neste caso
            $this->conn=new PDO("mysql:host={$this->host};dbname={$this->database};charset=utf8", $this->user, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND=> "SET NAMES utf8"));

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->conn->query('SET NAMES utf8');
        }

        catch(PDOException $e) {
            echo "Não foi possível conectar ao servidor.\n"."<br>";
            echo "Mensagem: ".utf8_encode($e->getMessage())."\n";
        }
    }

    //Método para executar instruções usadas nas inserções e modificações de dados
    // Insert update, não se espera resultado de dados
    function executeQuery($query){
        try {
            $conn=$this->connectDB();
            $resultado=$this->conn->prepare($query);

            if(!$resultado->execute()) {
                $resultado="Não foi possível executar a instrução";
            }

            else {
                $resultado=array('sucesso'=>1);
            }
        }

        catch(PDOException $e){
            die(print_r($e->getMessage()));
        }
        return $resultado;
    }

     //Método para executar instruções usadas nas consultas de dados
     function executeSelectQuery($query) {
         try{
             $conn = $this->connectDB();
             $resultado = $this->conn->query($query);
             $resultado -> execute();
         
            //Looping para percorer os registros da DB
            //o resultado vai para a variavel row após pesquisar todas as linhas do DB
             while($row = $resultado->fetch(PDO::FETCH_ASSOC)){
                //os resultados encaminhados para row serão armazenados em uma array da qual contém a condição de converter para codificação UTF8
                $resultset[] = array_map('utf8_encode',$row);
             }
             
            //Se o resultado não for vazio, retornará o valor do resultest
             if(!empty($resultset)){
                 return $resultset;
             }

         }
         catch(PDOException $e){
             die(print_r($e->getMessage()));
         }

     }

     function executeBuscaCodigoQuery($query){
        try {
            $conn=$this->connectDB();
            $resultado=$this->conn->prepare($query);

            if(!$resultado->execute()) {
                $resultado="Não foi possível executar a instrução";
            }

            else {
                    $row = $resultado->fetch();
                    if(!is_null($row[0])){
                        $resultado = $row[0]+1;
                    }
                    else{
                        $resultado = 1; 
                    }
            }
        }

        catch(PDOException $e){
            die(print_r($e->getMessage()));
        }
        return $resultado;
    }

    function executeProcedureOut($query,$array,$final) {
        try{
            $conn = $this->connectDB();
            //prepare para execução da stored procedure
            $stmt = $this->conn->prepare($query);
            
            foreach($array as $key => $value){
                $stmt->bindValue($key, $value);
            }
            $stmt -> execute();

        
           //Looping para percorer os registros da DB
           //o resultado vai para a variavel row após pesquisar todas as linhas do DB
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
               //os resultados encaminhados para row serão armazenados em uma array da qual contém a condição de converter para codificação UTF8
               $resultset[] = array_map('utf8_encode',$row);
            }
            
           //Se o resultado não for vazio, retornará o valor do resultest
            

        }
        catch(PDOException $e){
            die(print_r($e->getMessage()));
        }
        return $resultset;

    }

    function executeProcedure($query,$array) {
        try{
            $conn = $this->connectDB();
            //prepare para execução da stored procedure
            $stmt = $this->conn->prepare($query);
            
            foreach($array as $key => $value){
                $stmt->bindValue($key, $value);
            }
            $stmt -> execute();

        
           //Looping para percorer os registros da DB
           //o resultado vai para a variavel row após pesquisar todas as linhas do DB
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
               //os resultados encaminhados para row serão armazenados em uma array da qual contém a condição de converter para codificação UTF8
               $resultset[] = array_map('utf8_encode',$row);
            }
            
           //Se o resultado não for vazio, retornará o valor do resultest
            

        }
        catch(PDOException $e){
            die(print_r($e->getMessage()));
        }
        return $resultset;

    }
}
?>