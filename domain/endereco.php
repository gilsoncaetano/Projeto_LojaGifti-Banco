<?php


class Endereco{

  public $idendereco;
  public $tipo; 
  public $logradouro; 
  public $numero;
  public $complemento;
  public $bairro;
  public $cep;
  
  public function __construct($db){
    $this->conexao = $db;

}

public function listar(){
    $query = "select * from endereco";

    $stmt = $this->conexao->prepare($query);

    $stmte->execute();

    return $stmt;
}

public function cadastro(){
    $query = "insert into endereco set tipo=:t, logradouro=:l, numero=:n, complemento=:c, bairro=:b, cep=:ce";


    $stmte = $this->conexao->prepare($query);

    //Encriptografar a senha com o uso de md5
    $this->senha = md5($this->senha);

    /*Vamos vincular os dados que vem do app ou navegador com os campos de
    banco de dados
    */
    $stmte->bindParam(":t",$this->tipo);
    $stmte->bindParam(":l",$this->logradouro);
    $stmte->bindParam(":n",$this->numero);
    $stmte->bindParam(":c",$this->complemento);
    $stmte->bindParam(":b",$this->bairro);
    $stmte->bindParam(":ce",$this->cep);

    if($stmte->execute()){
        return true;

    }
    else{
        return false;
    }
}

public function alterarEndereco(){
    $query = "update endereco set  tipo=:t, logradouro=:l, numero=:n, complemento=:c, bairro=:b, cep=:ce where idendereco=:id";

    $stmte = $this->conexao->prepare($query);

  
    /*Vamos vincular os dados que vem do app ou navegador com os campos de
    banco de dados
    */
   
    $stmte->bindParam(":t",$this->tipo);
    $stmte->bindParam(":l",$this->logradouro);
    $stmte->bindParam(":n",$this->numero);
    $stmte->bindParam(":c",$this->complemento);
    $stmte->bindParam(":b",$this->bairro);
    $stmte->bindParam(":ce",$this->cep);
    $stmte->bindParam(":id",$this->idendereco);
    

    if($stmte->execute()){
        return true;
    }
    else{
        return false;
    }

}

public function apagarEndereco(){
    $query = "delete from endereco where idendereco=:id";

    $stmte = $this->conexao->prepare($query);

    
    /*Vamos vincular os dados que veem do app ou navegador com os campos de
    banco de dados
    */
   
    $stmte->bindParam(":id",$this->idendereco);

    if($stmte->execute()){
        return true;
    }
    else{
        return false;
    }

}

}

?>
