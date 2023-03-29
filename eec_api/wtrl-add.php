<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Content-Type");

function insertData($postObj) {
	include "./connect.php";
	$tokenServer = 'ZWVjSW9UYnlFbkdSSURzU3RhdGlvbjE=';
	$token = $postObj->token;
	$cid = time();
	if ($tokenServer == $token) {
		$sql = "INSERT INTO iotwtrl(cid, ts)VALUES($cid, now())";
		mysqli_query($objCon, $sql);

		$query = "";
		foreach ($postObj as $key => $value) {
			if (!empty($value) && $key != "token") {
				$sql2 = "UPDATE iotwtrl SET $key='$value' WHERE cid='$cid'";
				$query = mysqli_query($objCon, $sql2);
			}
		}
		if ($query) {
			http_response_code(200);
			echo json_encode([
				"status" => "success",
			]);
		}
		mysqli_close($objCon);
	}
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($_POST)) {
	$postObj = json_decode(file_get_contents('php://input'));
	insertData($postObj);
}
?>