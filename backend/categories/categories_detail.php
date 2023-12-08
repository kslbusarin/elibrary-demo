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
        if(isset($_GET['id']) && !empty($_GET['id'])){
            
            $id = $_GET['id'];
            
            //SQL select all
            // $sql = "select * from book  where \"bookId\" = '$id'";

            $sql = "select book.bookid,title,author.authorname, book.coverfileurl
                    ,year,category.categoryid,category.categoryname
                    from book  
                    join author_books abb
                    on book.bookid = abb.bookid
                    join author
                    on author.authorid = abb.authorid
                    join category_books cbb
                    on book.bookid = cbb.bookid
                    join category
                    on category.categoryid = cbb.categoryid
                    where category.categoryid = '$id'";
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

