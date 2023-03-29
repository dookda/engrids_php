<?php
    $db_config=array(
        "host"=>"10.110.0.37",  
        "user"=>"eeconepdb", 
        "pass"=>"oylOi73QWV4e",
        "dbname"=>"eeconepdb",  
        "charset"=>"utf8"  
    );
    $objCon = @new mysqli($db_config["host"], $db_config["user"], $db_config["pass"], $db_config["dbname"]);

    if(mysqli_connect_error()) {
        die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
        exit;
    }

    $objCon->set_charset("utf8");
?>