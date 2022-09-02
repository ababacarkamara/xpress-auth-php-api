<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods:  GET");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../../config/database.php';
    include_once '../../entities/user.php';
    $database = new Database();
    $db = $database->getConnection();
    $item = new User($db);
    $item->id = isset($_GET['id']) ? $_GET['id'] : die();
  
    $item->getSingleUser();
    if($item->email != null){
        // create array
        $user_arr = array(
            "id" => $item->id,
            "firtsname" => $item->firstname,
            "lastname" => $item->lastname,
            "email" => $item->email,
            "phone" => $item->phone,
            "created_at" => $item->created_at,
            "modified" => $item->modified

        );
      
        http_response_code(200);
        echo json_encode($user_arr);
        echo "\n User IP Address - ".$_SERVER['REMOTE_ADDR'];  

    }
      
    else{
        http_response_code(404);
        echo json_encode("User not found.");
        echo "\n User IP Address - ".$_SERVER['REMOTE_ADDR'];  
    }
?>