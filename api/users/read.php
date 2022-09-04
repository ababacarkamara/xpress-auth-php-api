<?php

require_once './../../config/db.php';
require_once './../jwt_utils.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");

$bearer_token = get_bearer_token();

#echo $bearer_token;

$is_jwt_valid = is_jwt_valid($bearer_token);

if($is_jwt_valid) {
    $data = json_decode(file_get_contents("php://input"));

	$sql = "SELECT username, email, phone FROM user WHERE username = '$data->username';";
	$results = dbQuery($sql);

	$rows = array();

	while($row = dbFetchAssoc($results)) {
		$rows[] = $row;
	}

	echo json_encode($rows);
} else {
	echo json_encode(array('error' => 'Access denied'));
}
