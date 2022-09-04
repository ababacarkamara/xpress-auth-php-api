<?php

require_once './../../config/db.php';
require_once './../jwt_utils.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
$bearer_token = get_bearer_token();

#echo $bearer_token;

$is_jwt_valid = is_jwt_valid($bearer_token);

if($is_jwt_valid) {

    if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        // get posted data
        $data = json_decode(file_get_contents("php://input"));

        $sql = "DELETE  FROM user WHERE  username = '$data->username';";
        
        $result = dbQuery($sql);
        
        if($result) {
            echo json_encode(array('success' => 'User deleted'));
        } else {
            echo json_encode(array('error' => 'Something went wrong, please contact administrator'));
        }
    }
} else {
	echo json_encode(array('error' => 'Access denied'));
}