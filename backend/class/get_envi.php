<?php
    //Define Access-Control-Allow-Origi
    header("Access-Control-Allow-Origin: *");
    
    header("Content-Type: application/json; charset=UTF-8");
    
    header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
    
    header("Access-Control-Max-Age: 3600");
    
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include("../class/connect_db.php");


    $sql = "select config_name, config_value from config";
    $result = pg_query($db_connection, $sql);
    while ($row = pg_fetch_assoc($result)) {
        $arr[] = $row;
    }

    echo json_encode($arr);
    

