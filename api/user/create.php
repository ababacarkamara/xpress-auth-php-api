<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../../config/database.php';
    include_once '../../entities/user.php';
    $database = new Database();
    $db = $database->getConnection();
    $item = new User($db);
    $data = json_decode(file_get_contents("php://input"));
    $item->firstname = $data->firstname;
    $item->lastname = $data->lastname;
    $item->email = $data->email;
    $item->phone = $data->phone;
    $item->created_at = date('Y-m-d H:i:s');
    $item->userPassword = md5($data->user_password);

    if($item->createUser()){
        echo 'User created successfully.';
    } else{
        echo 'User could not be created.';
        print_r($item);
    }
?>