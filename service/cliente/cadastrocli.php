<?php

/*
Vamos construir os cabeçalhos para trabalho com a api
*/
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=utf-8");

/*Para efetuar o cadastro de dados no banco é preciso
informar a api que essa ação irá ocorrer
*/
header("Access-Control-Allow-Methods:POST");

include_once "../../config/database.php";

include_once "../../domain/cliente.php";

$database = new Database();
$db = $database->getConnection();

$cliente = new Cliente($db);

/*
O cliente irá enviar os dado no formato Json. Porém
 nós precisamos dos dados no formato php para cadstra em
 banco de dados. 
 Para realizar essa conversão iremos usar o comando json_decode
 Assi o cliente envia os dados e estes serão convertidos para php
*/
$data = json_decode(file_get_contents("php://input"));

#Verificar se os dados vindos do cliente estão preenchidos
if(!empty($data->nomecliente) && !empty($data->cpf)&& !empty($data->sexo)&& !empty($data->telefone)&& !empty($data->email)){

    $cliente->telefone = $data->telefone;
    $cliente->email = $data->email;
    $cliente->nomecliente = $data->nomecliente;
    $cliente->cpf = $data->cpf;
    $cliente->sexo = $data->sexo;
    // $cliente->idcontato = $data->idcontato;
    // $cliente->idendereco = $data->idendereco;
    // $cliente->idusuario = $data->idusuario;
   

    if($cliente->cadastro()){
        header("HTTP/1.0 201");
        echo json_encode(array("mensagem"=>"cliente cadastrado com sucesso!"));
    }
    else{
        header("HTTP/1.0 400");
        echo json_encode(array("mensagem"=>"Não foi possível cadastrar"));
    }
}
else{
    header("HTTP/1.0 400");
    echo json_encode(array("mensagem"=>"Você precisa preencher todos os campos"));
}

?>