<?php

    //Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');

include_once '../../config/Database.php';
include_once '../../models/Produto.php';

    //Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

    //Instantiate Produto object
$produto = new Produto($db);

    //Get id
$produto->id = isset($_GET['id']) ? $_GET['id'] : die();

    //Get Produto
$produto->get_single();

$prod_arr = array(
    "id" => $produto->id,
    "produto" => $produto->prod
);

print_r( json_encode($prod_arr));