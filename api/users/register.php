<?php

require_once './../../config/db.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// get posted data
	$data = json_decode(file_get_contents("php://input", true));
	
	$sql = "INSERT INTO user(username, email, phone, ip, password) 
		VALUES('" . mysqli_real_escape_string($dbConn, $data->username) 
			. "', '" . mysqli_real_escape_string($dbConn, $data->email)
			. "', '" . mysqli_real_escape_string($dbConn, $data->phone)
			. "', '" . mysqli_real_escape_string($dbConn, $_SERVER['REMOTE_ADDR'])
			. "', '" . mysqli_real_escape_string($dbConn, md5($data->password)) . "')";
			
	
	$result = dbQuery($sql);
	
	if($result) {
		echo json_encode(array('success' => 'You registered successfully'));
	} else {
		echo json_encode(array('error' => 'Something went wrong, please contact administrator'));
	}
}
