<?php
    //Define Access-Control-Allow-Origi
    header("Access-Control-Allow-Origin: *");
    
    header("Content-Type: application/json; charset=UTF-8");
    
    header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
    
    header("Access-Control-Max-Age: 3600");
    
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include("../class/connect_db.php");



    $requestMethod = $_SERVER["REQUEST_METHOD"];
    
    //Check Method GET
    if($requestMethod == 'GET'){
        // Create array for keep fetch data
        $arr = array();

        //SQL where id
        if(isset($_GET['uid']) && !empty($_GET['uid'])){

            $id = $_GET['uid'];
            
            //SQL select all

            // $sql = "select fullname,fullname_en,faculty,department,email from psu_passport where uid = '0042150'";
            $sql = "select fullname,fullname_en,faculty,department,email from psu_passport where uid = '0042150'";
            $result = pg_query($db_connection, $sql);
            while ($row = pg_fetch_assoc($result)) {
                $arr[] = $row;
            }
        }
        else{
            $arr = ['empty'];
        }
  
        echo json_encode($arr);
    }

