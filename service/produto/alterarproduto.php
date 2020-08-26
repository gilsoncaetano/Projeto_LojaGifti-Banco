<?php

/*
Vamos construir os cabeçalhos para trabalho com a api
*/
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=utf-8");

/*Para efetuar o cadastro de dados no banco é preciso
informar a api que essa ação irá ocorrer com ométodo PUT, que 
responsável pela atualização de dados da api
*/
header("Access-Control-Allow-Methods:PUT");

include_once "../../config/database.php";

include_once "../../domain/produto.php";

$database = new Database();
$db = $database->getConnection();

$produto = new Produto($db);

/*
O cliente irá enviar os dado no formato Json. Porém
 nós precisamos dos dados no formato php para cadstra em
 banco de dados. 
 Para realizar essa conversão iremos usar o comando json_decode
 Assi o cliente envia os dados e estes serão convertidos para php
*/
$data = json_decode(file_get_contents("php://input"));

#Verificar se os dados vindos do usuário estão preenchidos
if(!empty($data->idproduto) && !empty($data->nomeproduto) && !empty($data->descricao) && !empty($data->preco)){

   
    $produto->nomeproduto = $data->nomeproduto;
    $produto->descricao = $data->descricao;
    $produto->preco = $data->preco;
    $produto->idproduto=$data->idproduto;

    if($produto->alterarProduto()){
        header("HTTP/1.0 201");
        echo json_encode(array("mensagem"=>"Produto alterada com sucesso!"));
    }
    else{
        header("HTTP/1.0 400");
        echo json_encode(array("mensagem"=>"Não foi possível alterar o produto"));
    }
}
else{
    header("HTTP/1.0 400");
    echo json_encode(array("mensagem"=>"Você precisa preencher todos os campos"));
}

?>