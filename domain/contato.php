<?php

class Contato{
    public $idcontato;
    public $email;
    public $telefone;

    public function __construct($db){
        $this->conexao = $db;
    }

    public function listar(){
        $query = "select * from contato";
    
        $stmt = $this->conexao->prepare($query);
    
        $stmt->execute();
    
        return $stmt;
    }

    public function cadastro(){
        $query = "insert into contato set email=:e, telefone=:t";

        $stmt = $this->conexao->prepare($query);

        //Encriptografar a senha com o uso de md5
        $this->senha = md5($this->senha);

        /*Vamos vincular os dados que vem do app ou navegador com os campos de
        banco de dados
        */
        $stmt->bindParam(":e",$this->email);
        $stmt->bindParam(":t",$this->telefone);

        if($stmt->execute()){
            return true;

        }
        else{
            return false;
        }
    }

    public function alterarContato(){
        $query = "update contato set email=:e, telefone=:t where idcontato=:id";

        $stmt = $this->conexao->prepare($query);

      
        /*Vamos vincular os dados que veem do app ou navegador com os campos de
        banco de dados
        */
       
        $stmt->bindParam(":e",$this->email);
        $stmt->bindParam(":t",$this->telefone);
        $stmt->bindParam(":id",$this->idcontato);
        

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }

    }

    public function apagarContato(){
        $query = "delete from contato where idcontato=:id";

        $stmt = $this->conexao->prepare($query);

        
        /*Vamos vincular os dados que veem do app ou navegador com os campos de
        banco de dados
        */
       
        $stmt->bindParam(":id",$this->idcontato);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }

    }

}

?>