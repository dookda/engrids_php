<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Content-Type");

function getData($postObj) {
	include "./connect.php";
	// $param = $postObj->param;
	$limit = $postObj->limit;
	$stname = $postObj->station;

	$products_arr["data"] = array();
	$strSQL = "select a.* from (SELECT stname, deep, temperature, humidity,
			time(ts) as t, DATE_FORMAT(ts, '%d-%m-%y') as d
		FROM iotwtrl WHERE stname='$stname' ORDER BY ts DESC limit $limit) a
		ORDER BY a.t ASC";
	$objQuery = mysqli_query($objCon, $strSQL);
	while ($row = mysqli_fetch_array($objQuery, MYSQLI_ASSOC)) {
		array_push($products_arr["data"], $row);
	}
	http_response_code(200);
	echo json_encode($products_arr);
	mysqli_close($objCon);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($_POST)) {
	$postObj = json_decode(file_get_contents('php://input'));
	getData($postObj);
}

?>
