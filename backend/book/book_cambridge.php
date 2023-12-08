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

            //SQL select all
            $sql = "select book.bookid,book.title,book.bookviewcount,book.coverfileurl
            from book
            where book.status=true
            and book.isbn like '%(ebook)'
            order by book.bookid desc limit 8";
            
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

