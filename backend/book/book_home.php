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
            $sql = "select book.bookid,book.title,author.authorname,book.bookviewcount,book.coverfileurl, count(borrow.bookid) as count  from book
            inner join (
                select max(author_books.authorid) as max_auid,book.bookid from book
               left join author_books
              on book.bookid = author_books.bookid
              left join  author
              on author.authorid = author_books.authorid
              where book.status=true
              group by author_books.bookid,book.bookid
              order by bookid desc
          ) as au_id
          on au_id.bookid = book.bookid
          left join author 
          on au_id.max_auid  = author.authorid
          left join borrow
          on book.bookid = borrow.bookid
          where book.status = true
          group by book.bookid,book.title,author.authorname,book.bookviewcount,book.coverfileurl
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

