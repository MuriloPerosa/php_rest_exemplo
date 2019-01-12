<?php

    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=UTF-8');
    header('Access-Control-Allow-Methods: DELETE');
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


    //delete produto
    if($produto->delete()){
        echo(json_encode(array("message"=> "Produto removido com sucesso.")));
    }else{
        echo(json_encode(array("message"=> "Falha ao remover produto.")));
    }