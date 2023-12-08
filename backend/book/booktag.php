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
        if(isset($_GET['bookid']) && !empty($_GET['bookid'])){
            $id = $_GET['bookid'];
            
            //SQL select all
            // $sql = "select * from book  where \"bookId\" = '$id'";

            $sql = "select tagname from public.book
            join tag_books 
            on book.bookid = tag_books.bookid
            join tag
            on tag.tagid = tag_books.tagid
          where book.bookid = '$id'";
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

