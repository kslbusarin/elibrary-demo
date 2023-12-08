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
    $status_all = array();
    //Check Method GET
    if($requestMethod == 'POST'){
        // echo  $_POST['bookBookId'];
        if(isset($_POST['bookid']) && !empty($_POST['bookid'])){
            // 1. get bookID and Userid
            $bookid = $_POST['bookid'];
            $userid = $_POST['userid'];
            $uid = $_POST['uid'];

            // 2. Create event for return book
            $status_all = return_book($bookid, $userid,$db_connection,$status_all);

            // 3. Calculate amount book after return
            $status_all = cal_amount_book($bookid,$db_connection,$status_all);

            // 4. Remove file
            remove_file($bookid,$uid);
        }
        else{
            $status =  "User must have sent wrong inputs";
        }
        // Return result to front end
        echo json_encode($status_all);
        
    }

    function return_book($bookid, $userid,$db_connection,$status_all){

        $sql = "update public.borrow set
        isreturn = true
        where bookid = '$bookid'
        and userid='$userid'";
        
        $result = pg_query($db_connection, $sql);
        if ($result) {
            $status =  "Return status is successfully";
            array_push($status_all, array("state_return" => $status));
        } else {
            $status =  "User must have sent wrong inputs borrow";
        }
        return $status_all;
    }

    function cal_amount_book($bookid,$db_connection,$status_all){
        if("borrow success"=="borrow success"){
            $sql = "update public.book set
                amountleft = amountleft+1
                where bookid = '$bookid'";
            $result = pg_query($db_connection, $sql);
            if ($result) {
                $status =  "Calculate amount return is successfully";
                array_push($status_all, array("state_calculate" => $status));
            } else {
                $status =  "User must have sent wrong inputs amount";
            }
        }
        return $status_all;
    }

    function remove_file($bookid,$uid){
        ini_set('max_execution_time', '3600');
        
        $clone_dir ="../../../fs/pdf/$bookid/clone/";   // Same site
        $pathname = $clone_dir.$uid."/";
        // echo $pathname;
        if (is_dir($pathname)) {
            system("rm -rf ".escapeshellarg($pathname));
            // echo "Delete complete";
        }
        else{
            // echo "Error";
        }


        $pathname = "../../file_preview/files/".$bookid."/".$uid;    
                 
        // echo  $pathname.PHP_EOL;
        if (is_dir($pathname )) {system("rm -rf ".escapeshellarg($pathname));}


        
        // $clone_dir ="https://dev-elibrary.psu.ac.th/fileserver/remove_file.php?bookid=308&uid=0042150";   // Diff site
        //$output = shell_exec("../../../fs/remove_file.php?bookid=$bookid&uid=$uid");
        // $output = shell_exec("http://192.168.27.15/demo6/remove_file.php?bookid=308&uid=0042150");
        // echo "<pre>$output</pre>";
        // $pathname = $clone_dir.$uid."/";
        // if (is_dir($pathname )) {system("rm -rf ".escapeshellarg($pathname));}

        // echo "Complete.";
    }

