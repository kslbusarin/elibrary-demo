<?php
    session_start();
    //Define Access-Control-Allow-Origi
    header("Access-Control-Allow-Origin: *");
    
    header("Content-Type: application/json; charset=UTF-8");
    
    header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
    
    header("Access-Control-Max-Age: 3600");
    
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include("../class/connect_db.php");

    
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    //Check Method GET
    if($requestMethod == 'POST'){
        $arr = array();
        //SQL where id
        // echo  $_POST['bookBookId'];
        if(isset($_POST['username']) && !empty($_POST['username'])){
            // get bookID and Userid
            $username = $_POST['username'];
            // Create event for return book
            $sql = "select * from psu_passport where login = '$username' limit 1";
    
            $result = pg_query($db_connection, $sql);
            $rows = pg_num_rows($result);
            if ($rows>0) {
                while ($row = pg_fetch_assoc($result)) {
                            $arr[] = $row;
                            $_SESSION['login_uid']=$row["uid"];
                        }

                if(isset($_POST['tmpbookurl']) && !empty($_POST['tmpbookurl'])){
                    array_push($arr, array("tmpbookurl" => $_POST['tmpbookurl']));
                }
                
            }
            else{
                $arr["action"] = false;
            }    
        }
        echo json_encode($arr);
    }


