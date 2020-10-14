<?php
 
class Produto{

public $idproduto;
public $nomeproduto;
public $descricao;
public $preco;
public $idfoto;

public function __construct($db){
    $this->conexao = $db;

}

public function listar(){
    $query = "select * from produto";

    $stmt = $this->conexao->prepare($query);

    $stmt ->execute();

    return $stmt;

   }

   public function detalheProduto($id){
       $query = "select p.idproduto, p.nomeproduto, p.descricao, p.preco, f.foto1, f.foto2,f.foto3,f.foto4  
       from produto p inner join foto f on p.idfoto=f.idfoto where idproduto=:id";
       
       $stmt=$this->conexao->prepare($query);

       $stmt->bindParam(":id",$id);

       $stmt->execute();

       return $stmt;
   }

   public function listarTelaInicial(){
    $query = "select p.idproduto,p.nomeproduto,p.preco,f.foto1 from produto p inner join foto f on p.idfoto=f.idfoto";
    $stmt = $this->conexao->prepare($query);
    
    $stmt ->execute();

    return $stmt;

   }
   
   public function cadastro(){
    $query = "insert into produto set nomeproduto=:n, descricao=:d, preco=:p, idfoto=:i";

    $stmt = $this->conexao->prepare($query);


    /*Vamos vincular os dados que vem do app ou navegador com os campos de
    banco de dados
    */
    $stmt->bindParam(":n",$this->nomeproduto);
    $stmt->bindParam(":d",$this->descricao);
    $stmt->bindParam(":p",$this->preco);
    $stmt->bindParam(":i",$this->idfoto);

    if($stmt->execute()){
        return true;

    }
    else{
        return false;
    }
}

public function alterarProduto(){
    $query = "update produto set nomeproduto=:n, descricao=:d, preco=:p where idproduto=:id";

    $stmt = $this->conexao->prepare($query);

  
    /*Vamos vincular os dados que veem do app ou navegador com os campos de
    banco de dados
    */
   
    $stmt->bindParam(":n",$this->nomeproduto);
    $stmt->bindParam(":d",$this->descricao);
    $stmt->bindParam(":p",$this->preco);
    $stmt->bindParam(":id",$this->idproduto);
    

    if($stmt->execute()){
        return true;
    }
    else{
        return false;
    }

}

public function alterarFoto(){
    $query = "update produto set idfoto=:i where idproduto=:id";

    $stmt = $this->conexao->prepare($query);

  
    /*Vamos vincular os dados que veem do app ou navegador com os campos de
    banco de dados
    */
   
    
    $stmt->bindParam(":i",$this->idfoto);
    $stmt->bindParam(":id",$this->idproduto);
    

    if($stmt->execute()){
        return true;
    }
    else{
        return false;
    }

}

public function apagarProduto(){
    $query = "delete from produto where idproduto=:id";

    $stmt = $this->conexao->prepare($query);

    
    /*Vamos vincular os dados que veem do app ou navegador com os campos de
    banco de dados
    */
   
    $stmt->bindParam(":id",$this->idproduto);

    if($stmt->execute()){
        return true;
    }
    else{
        return false;
    }

  }

}

?>