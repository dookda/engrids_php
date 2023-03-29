<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Content-Type");

function getData($postObj){
    include("./connect.php");

    $products_arr["data"]=array();

    $strSQL = "SELECT * FROM iotwtrl ORDER BY ts desc limit 100";

    $objQuery = mysqli_query($objCon, $strSQL);
    while($row = mysqli_fetch_array($objQuery, MYSQLI_ASSOC)){
        array_push($products_arr["data"], $row);
    }
    http_response_code(200);
    echo json_encode($products_arr);
    mysqli_close($objCon);
}

getData($postObj);
     
?>
