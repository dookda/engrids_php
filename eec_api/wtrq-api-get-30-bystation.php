<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Content-Type");

function getData($stname, $limit) {
	include "./connect.php";

	$products_arr["data"] = array();
	$strSQL = "SELECT stname, do, ec, ph, tmp, ts 
			FROM eeconepdb.iotwtrq
            WHERE stname = '$stname' 
            ORDER BY ts DESC
            LIMIT $limit";

	$objQuery = mysqli_query($objCon, $strSQL);
	while ($row = mysqli_fetch_array($objQuery, MYSQLI_ASSOC)) {
		array_push($products_arr["data"], $row);
	}
	http_response_code(200);
	echo json_encode($products_arr);
	mysqli_close($objCon);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	// $postObj = json_decode(file_get_contents('php://input'));
	getData($_GET['stname'], $_GET['limit']);
}

?>