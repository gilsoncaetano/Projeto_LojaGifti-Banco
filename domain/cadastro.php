<?php

class Cadastro{

    public $idcliente;
    public $nomecliente;
    public $cpf;
    public $sexo;
    public $idcontato;
    public $idendereco;
    public $idusuario;
    public $telefone;
    public $email;
    public $tipo; 
    public $logradouro; 
    public $numero;
    public $complemento;
    public $bairro;
    public $cep;
    public $nomeusuario;
    public $senha;
    public $foto;

    public function __construct($db){
        $this->conexao = $db;
    }

    public function cadastro(){


        // $endereco = "SELECT * FROM endereco order by idendereco desc limit 0,1;";
        // $stmt = $this->conexao->prepare($endereco);
        // $rs = $stmt->execute();
    
        // while($linha = $rs->fetch(PDO::FETCH_ASSOC)){
        //     $this->idendereco=$linha["idendereco"];
        // }
    
    
        // $usuario = "SELECT * FROM usuario order by idusuario desc limit 0,1;";
        // $stmt = $this->conexao->prepare($usuario);
        // $rs = $stmt->execute();
    
        // while($linha = $rs->fetch(PDO::FETCH_ASSOC)){
           

    $query = "insert into usuario set nomeusuario=:n, senha=:s, foto=:f";
    
    $stmtu = $this->conexao->prepare($query);
    
     //Encriptografar a senha com o uso de md5
    $this->senha = md5($this->senha);
    
    /*Vamos vincular os dados que veem do app ou navegador com os campos de
    banco de dados
            */
    $stmtu->bindParam(":n",$this->nomeusuario);
    $stmtu->bindParam(":s",$this->senha);
    $stmtu->bindParam(":f",$this->foto);

    //Vamos executar a consulta para realizar o cadastro na tabela usuario
    $stmtu->execute();

    //Vamos obter o ID gerado neste cadastro
    $this->idusuario = $this->conexao->lastInsertId();

//======================== do contato ==========================

    $query = "insert into contato set email=:e, telefone=:t";

    $stmtc = $this->conexao->prepare($query);

    /*Vamos vincular os dados que vem do app ou navegador com os campos de
     banco de dados
     */
    $stmtc->bindParam(":e",$this->email);
    $stmtc->bindParam(":t",$this->telefone);

    $stmtc->execute();

    $this->idcontato=$this->conexao->lastInsertId();
  

    //======================== cadastro do endereço ===================

    $query = "insert into endereco set tipo=:t, logradouro=:l, numero=:n, complemento=:c, bairro=:b, cep=:ce";

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

    $stmte->execute();
    $this->idendereco=$this->conexao->lastInsertId();


    //===================== cadastro do cliente =========================

    $query = "insert into cliente set nomecliente=:n,cpf=:c,sexo=:s,idcontato=:ic,idendereco=:ie,idusuario=:iu";

    $stmt = $this->conexao->prepare($query);

    /*Vamos vincular os dados que veem do app ou navegador com os campos de
    banco de dados
    */

    $stmt->bindParam(":n",$this->nomecliente);
    $stmt->bindParam(":c",$this->cpf);
    $stmt->bindParam(":s",$this->sexo);
    $stmt->bindParam(":ic",$this->idcontato);
    $stmt->bindParam(":ie",$this->idendereco);
    $stmt->bindParam(":iu",$this->idusuario);

    if($stmt->execute()){
        
        
        return true;
    }
    else{
        return false;
    }

    }


}
?>