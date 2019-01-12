<?php

    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=UTF-8');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Produto.php';

    //Instantiate DB & Connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate Produto object
    $produto = new Produto($db);

    //Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    //Set id to Update
    $produto->id = $data->id;

    $produto->prod = $data->prod;

    //update prod
    if($produto->update()){
        echo(json_encode(array("message"=> "Produto atualizado com sucesso.")));
    }else{
        echo(json_encode(array("message"=> "Falha ao atualizar produto.")));
    }