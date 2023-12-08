<?php
    // Function for check user borrow this book
    //Define Access-Control-Allow-Origi
    header("Access-Control-Allow-Origin: *");
    
    header("Content-Type: application/json; charset=UTF-8");
    
    header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
    
    header("Access-Control-Max-Age: 3600");
    
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include("../class/connect_db.php");

    
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    $isreturn = null;
    $result_all = array();
    //Check Method GET
    if($requestMethod == 'GET'){
        // 1. Create array for keep fetch data from frontend
        $all_key_value =  $_SERVER['QUERY_STRING'];
        // echo $all_key_value;

        // 2. Create array for keep data from frontend each parameter
        $arr_key_value = explode ("&", $all_key_value); 

        // 3. Check parameter is no empty
        //SQL where id
        if(isset($all_key_value) && !empty($all_key_value)){

            // 4. Get return status 
            $sql = "select borrow.isreturn,bl.borrowdaylimit
            from borrow
            left join 
            users 
            on borrow.userid = users.userid
            left join
            borrow_level bl
            on bl.borrowlevelid = users.borrowlevelid
                    where borrow.bookid = '$arr_key_value[0]' and borrow.userid = '$arr_key_value[1]' 
                    order by borrow.borrowstartdate desc limit 1;";
            $result = pg_query($db_connection, $sql);
            while ($row = pg_fetch_assoc($result)) {
                $result_all = $row;
            }
            // echo $isreturn;
            // If isreturn is t = user is return If f = user is borrow
            // if($isreturn == 't'){
            //     // $val_isreturn = true;
            // }
            // elseif($isreturn == 'f'){
            //     // $val_isreturn = false;
            // }
            // else{
            //     $val_isreturn = $isreturn;
            // }

        //    echo $val_isreturn;
        }
        else{
                /// do something
        }
        echo json_encode($result_all);
    }

