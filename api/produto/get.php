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

    //Produto query
$result = $produto->get();

    //Get Result row count
$num = $result->rowCount();

    //Check if any result
if ($num > 0) {
    //Produtos array
    $prod_array = array();
    // $prod_array["data"] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $prod_item = array(
            "id" => $id,
            "produto" => $prod
        );

        http_response_code(200);
        //Push to "data"
        array_push($prod_array, $prod_item);

    }

    //Turn to JSON & output
    echo json_encode($prod_array);

} else {
    //No Produtos
    echo json_encode(array('message' => 'Nenhum produto encontrado.'));
}
