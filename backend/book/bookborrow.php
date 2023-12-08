<?php
    //Define Access-Control-Allow-Origi
    header("Access-Control-Allow-Origin: *");
    
    header("Content-Type: application/json; charset=UTF-8");
    
    header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
    
    header("Access-Control-Max-Age: 3600");
    
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include("../class/connect_db.php");

    
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    $status = "";
    $quota_borrow;
    $sum_available_book;
    $status_all = array();
    $arr = array();
    //Check Method POST
    if($requestMethod == 'POST'){
        // Create array for keep fetch data
        //SQL where id
        // echo  $_POST['bookBookId'];
        if(isset($_POST['bookid']) && !empty($_POST['bookid'])){
            // 1. get bookID and Userid
            $bookid = $_POST['bookid'];
            $userid = $_POST['userid'];

            // 2. Check borrow level quota limit borrow day limit borrow
            $amountlimit = check_borrow_level($db_connection, $userid);
            // echo $amountlimit["borrowamountlimit"];

            // 3. Calculate available number
            $sum_borrow = sum_borrow($db_connection, $userid);
            // echo "----".$sum_borrow;
            $quota_borrow = $amountlimit["borrowamountlimit"]-$sum_borrow;
            // echo "quota is ".$quota_borrow;

            // 4. Check available book
            $sum_available_book = sum_available_book($db_connection,$bookid);
            // echo "amount left is ".$sum_available_book;

            // 5. Check borrow permission
            if($quota_borrow && $sum_available_book > 0){
                // Create event for borrow book
                $status_all = borrow_book($bookid, $userid,$db_connection,$status_all,$quota_borrow,$sum_available_book);
                // Create event after borrow book
                $status_all = cal_amount_book($bookid,$db_connection,$status_all);
            }
            else{
                if($quota_borrow==0){
                    array_push($status_all, array("state" => False));
                    array_push($status_all, array("state_borrow" => "limitquota"));
                }
                if($sum_available_book==0){
                    array_push($status_all, array("state" => False));
                    array_push($status_all, array("state_borrow" => "emptybook"));
                }
                
            }
            
        }
        else{
            $status =  "User must have sent wrong inputs";
        }
        echo json_encode($status_all);
        
    }

    function check_borrow_level($db_connection, $userid){
        $borrow_limit=array();
        $sql = "select bl.borrowamountlimit,bl.borrowdaylimit from 
        psu_passport pp
        left join borrow_level bl
        on pp.type= bl.borrowlevelname
        where pp.userid = $userid";
        $result = pg_query($db_connection, $sql);
        while ($row = pg_fetch_assoc($result)) {
            $borrow_limit = $row;
        }
        return $borrow_limit;
    }

    function sum_borrow($db_connection, $userid){
        $sum_borrow=0;
        $sql = "select count(*) from borrow 
        where userid = $userid and isreturn = false
        group by userid";
        $result = pg_query($db_connection, $sql);
        while ($row = pg_fetch_assoc($result)) {
            $sum_borrow = $row["count"];
        }
        return $sum_borrow;
    }

    function sum_available_book($db_connection,$bookid){
        $sum_available_book=0;
        $sql = "select amountleft from book 
        where bookid = $bookid";
        $result = pg_query($db_connection, $sql);
        while ($row = pg_fetch_assoc($result)) {
            $sum_available_book = $row["amountleft"];
        }
        return $sum_available_book;
    }

    function borrow_book($bookid, $userid,$db_connection,$status_all,$quota_borrow,$sum_available_book){
        $date = new Datetime();
        $date->setTimezone(new DateTimeZone('Asia/Bangkok'));
        $borrowdate = $date->format('Y-m-d H:i:s.ms');            
        $sql = "insert into public.borrow(
            borrowstartdate, isreturn, readurl, bookid, userid)
            VALUES ('$borrowdate', false, '', '$bookid', '$userid')";
        $result = pg_query($db_connection, $sql);
        if ($result) {
            $status =  "Borrow is successfully";
            array_push($status_all, array("state" => True));
            array_push($status_all, array("state_borrow" => $status));
        } else {
            $status =  "User must have sent wrong inputs borrow";
            array_push($status_all, array("state" => False));

                    array_push($status_all, array("state_borrow" => $quota_borrow));
                

                    array_push($status_all, array("state_borrow" => $sum_available_book));
        }
        return $status_all;
    }

    function cal_amount_book($bookid,$db_connection,$status_all){
        if("borrow success"=="borrow success"){
            $sql = "update public.book set
                amountleft = amountleft-1
                where bookid = '$bookid'";
            $result = pg_query($db_connection, $sql);
            if ($result) {
                $status =  "Calculate amount is successfully";
                array_push($status_all, array("state_calculate" => $status));
            } else {
                $status =  "User must have sent wrong inputs amount";
            }
        }
        return $status_all;
    }

    function  close_connection(){
    }

