<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Content-Type");

function getData($postObj) {
	include "./connect.php";
	$param = $postObj->param;
	$limit = $postObj->limit;
	$stname = $postObj->stname;
	$sort = $postObj->sort;

	$products_arr["data"] = array();
	$strSQL = "SELECT stname, $param as val, time(ts) as t FROM iotwtrq WHERE stname = '$stname' ORDER BY ts $sort limit $limit";
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
