<?php
    // Show all book to index page
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
        //check id GET
        if(isset($_GET['id']) && !empty($_GET['id'])){
            
            $id = $_GET['id'];
            
            //SQL where id
            $sql = "select b.bookid, b.title, br.borrowstartdate, 
            br.borrowstartdate + (interval '1' day * bl.borrowdaylimit ) as borrowenddate
            from borrow br
            join users u
            on br.userid = u.userid
            join borrow_level bl
            on bl.borrowlevelid = u.borrowlevelid
            join book b
            on b.bookid = br.bookid
            where u.userid=$id
            and br.isreturn = false";
            
        }else{
            //SQL select all
            $sql = "select b.bookid, b.title, br.borrowstartdate, 
            br.borrowstartdate + (interval '1' day * bl.borrowdaylimit ) as borrowenddate
            from borrow br
            join users u
            on br.userid = u.userid
            join borrow_level bl
            on bl.borrowlevelid = u.borrowlevelid
            join book b
            on b.bookid = br.bookid
            where br.isreturn = false";
            
        }
        
        $result = pg_query($db_connection, $sql);
        
        //Crate array parameter
        $arr = array();
        
        // Fetch data to array
        while ($row = pg_fetch_assoc($result)) {
             
             $arr[] = $row;
        }
        
        // encode data in json
        echo json_encode($arr);
    }

