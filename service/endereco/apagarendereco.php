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
header("Access-Control-Allow-Methods:DELETE");

include_once "../../config/database.php";

include_once "../../domain/endereco.php";

$database = new Database();
$db = $database->getConnection();

$endereco = new Endereco($db);

/*
O cliente irá enviar os dado no formato Json. Porém
 nós precisamos dos dados no formato php para cadastra em
 banco de dados. 
 Para realizar essa conversão iremos usar o comando json_decode
 Assi o cliente envia os dados e estes serão convertidos para php
*/
$data = json_decode(file_get_contents("php://input"));

#Verificar se os dados vindos do endereço estão preenchidos
if(!empty($data->idendereco)){

    $endereco->idendereco=$data->idendereco;
    $endereco->tipo = $data->tipo;
    $endereco->logradouro = $data->logradouro;
    $endereco->numero = $data->numero;
    $endereco->complemento = $data->complemento;
    $endereco->bairro = $data->bairro;
    $endereco->cep = $data->cep;
    

    if($endereco->apagarEndereco()){
        header("HTTP/1.0 200");
        echo json_encode(array("mensagem"=>"Dados de Endereço apagado com sucesso!"));
    }
    else{
        header("HTTP/1.0 400");
        echo json_encode(array("mensagem"=>"Não foi possível apagar dados do endereço"));
    }
}
else{
    header("HTTP/1.0 400");
    echo json_encode(array("mensagem"=>"Você precisa preencher todos os campos"));
}

?>