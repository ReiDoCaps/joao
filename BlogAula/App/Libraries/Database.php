<?php
class Database{
    private $host = "localhost";
    private $usuario = "root";
    private $senha = "";
    private $banco = "blogaula";
    private $porta = "3306"; //verificar a porta do seu banco
    private $dbh;
    private $stmt;

    public function __construct(){
        //fonte de dados ou DNS  que contém as informações para conectar ao banco de dados.
        $dns = 'mysql:host='.$this->host.';port='.$this->porta.';dbname='.$this->banco;
        
        $opcoes = [
             //armanezar em cache a conexão para ser reutilizada, evitando sobrecarga de uma nova conexão. 
            PDO::ATTR_PERSISTENT => true,
            //lança um PDOException se ocorrer um erro
            PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION
        ];
        try{
            //cria a instacia do PDO
            $this->dbh = new PDO($dns, $this->usuario, $this->senha, $opcoes);
        }catch(PDOException $error){
          print "Error!";$error->getMessage()."<br/>";
          die();
          //fala
        }//fim do catch
    }//fim do método construtor


    public function query($sql){
        $this->stmt= $this->dbh->prepare($sql); 
    }

    public function bind($parametro, $valor, $tipo= null){
        if(is_null($tipo)):
            switch(true):
                case is_int($valor):
                    $tipo = PDO::PARAM_INT;
                    break;
                case is_bool($valor):
                    $tipo = PDO::PARAM_BOOL;
                    break;
                case is_null($valor):
                    $tipo =  PDO::PARAM_NULL;
                    break;
                endswitch;
            endif;
      }

      {
        
    }// fim da funcao bind
//executa prepared statement
public function executa(){
    return $this -> stmt ->execute();
    }//fim da função executa
    
    //obtem um unico registo
    public function resultado(){
    $this -> executa();
    return $this -> stmt -> fetch(PDO::FETCH_OBJ);
    }//fimd a funcao resultados
    
    //obtem um conjunto de registros
    public function resultados(){
    $this -> executa();
    return $this -> stmt -> fecthAll(PDO::FETCH_OBJ);
    }///fim da funcao resultados
    
    //retorna o numero de linhas afetadas pela ultima instruçã SQL
    public function totalResultados(){
    return $this -> stmt -> rowCount();
    }//fim da função totalResultados
    
}//fim da classe Database
