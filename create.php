<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/animals.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Animals($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->name = $data->name;
    $item->animal = $data->animal;
    $item->age = $data->age;
    $item->born = date('Y-m-d H:i:s');
    $item->hungry = $data->hungry;

    if($item->createAnimal()){
        echo 'Animal created successfully.';
    } else{
        echo 'Animal could not be created.';
    }
?>