<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Content-Type");

function getData($postObj){
    include("./connect.php");

    $products_arr["data"]=array();
    $strSQL = "SELECT j.* FROM iotwtrl j 
                RIGHT JOIN ( SELECT stname, max(ts) as ts FROM iotwtrl
                              GROUP BY stname ) i
                ON j.ts = i.ts
                ORDER BY i.stname";

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
