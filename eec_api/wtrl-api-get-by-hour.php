<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Content-Type");

function getData($postObj) {
	include "./connect.php";

	$products_arr["data"] = array();
	$strSQL = "SELECT stname, DATE_FORMAT(ts, '%d-%m-%Y') as dt,
                AVG(deep) as dept,
                AVG(humidity) as humi,
                AVG(temperature) as temp
            FROM eeconepdb.iotwtrl
            WHERE stname = 'station_01'
            GROUP BY stname, DATE(ts)
            ORDER BY ts ASC";

	$objQuery = mysqli_query($objCon, $strSQL);
	while ($row = mysqli_fetch_array($objQuery, MYSQLI_ASSOC)) {
		array_push($products_arr["data"], $row);
	}
	http_response_code(200);
	echo json_encode($products_arr);
	mysqli_close($objCon);
}

getData($postObj);

?>
