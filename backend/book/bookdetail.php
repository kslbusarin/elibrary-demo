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

            $sql = "select book.bookid,title,book.description,author.authorname, book.coverfileurl, book.bookviewcount
            ,publisher.publishername, year,category.categoryname
            ,book.bookviewcount, book.amount, book.amountleft, count(borrow.bookid)  from book
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
		  left join publisher_books pbb
          on book.bookid = pbb.bookid
		  left join publisher
          on publisher.publisherid = pbb.publisherid
		  left join category_books cbb
          on book.bookid = cbb.bookid
		  left join category
          on category.categoryid = cbb.categoryid
          where book.bookid = '$id'
          group by book.bookid,book.title,author.authorname,book.bookviewcount,
		  book.coverfileurl,publisher.publishername,category.categoryname";
            $result = pg_query($db_connection, $sql);
            while ($row = pg_fetch_assoc($result)) {
                $arr[] = $row;
            }
            // Update viewcount
            if($result){
                        $sql_update = "update book set bookviewcount = bookviewcount + 1
                        where book.bookid = '$id'";
                    $result_update = pg_query($db_connection, $sql_update);
            }
        }
        else{
            $arr = ['empty'];
        }
  
        echo json_encode($arr);
    }

