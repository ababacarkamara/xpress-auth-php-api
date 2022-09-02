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
    
    $item->id = $data->id;
    
    // user values
    $item->firstname = $data->firstname;
    $item->lastname = $data->lastname;
    $item->email = $data->email;
    $item->phone = $data->phone;
    $item->created_at = date('Y-m-d H:i:s');
    
    if($item->updateUser()){
        echo json_encode("User data updated.\n");
        echo 'User IP Address - '.$_SERVER['REMOTE_ADDR'];  
    } else{
        echo json_encode("Data could not be updated \n");
        echo 'User IP Address - '.$_SERVER['REMOTE_ADDR'];  

    }
?>