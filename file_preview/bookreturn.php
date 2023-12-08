<?php
include '../backend/class/connect_db.php';
ini_set('max_execution_time', '7200');

$interrow  = pg_query($db_connection, "SELECT borrowdaylimit FROM borrow_level Where borrowlevelname = 'Staffs';");
$blimit = pg_fetch_array($interrow);
$interday1 = $blimit["borrowdaylimit"];
echo  "Staffs borrow day limit = ".$interday1." day".PHP_EOL;

$interrow  = pg_query($db_connection, "SELECT borrowdaylimit FROM borrow_level Where borrowlevelname = 'Students';");
$blimit = pg_fetch_array($interrow);
$interday2 = $blimit["borrowdaylimit"];
echo  "Students borrow day limit = ".$interday2." day".PHP_EOL;

// $interday1 = "0";
// $interday2 = "0";


        // $myfile = fopen("./logs/".date("Y-m-d")."-bookreturn.txt", "w") or die("Unable to open bookreturn.txt mode > w");fclose($myfile);
        // $myfile = fopen("./logs/".date("Y-m-d")."-bookreturn.txt", "a") or die("Unable to open bookreturn.txt mode > a");

        $interval1 =  "select borrowstartdate,isreturn,bookid,A.userid,A from borrow A
        left join users B
        on A.userid = B.userid  
        Where 
        B.borrowlevelid = 1 
        And
        A.borrowstartdate <= now() - INTERVAL '".$interday1." DAYS'
        And
        A.isreturn = false
        order by A.bookid, A.borrowstartdate desc";

                    $result = pg_query($db_connection, $interval1);
                    while ($row = pg_fetch_array($result)) 
                    {
                        echo $row['bookid'].PHP_EOL;     
                        echo $row['userid'].PHP_EOL;   


                        $result_pass = pg_query($db_connection, "select uid from psu_passport where userid =".$row['userid']);                        
                        $uid = pg_fetch_array($result_pass); 
                        
                        $pathname = "./files/".$row['bookid']."/".$uid["uid"];    
                        echo  $pathname.PHP_EOL;

                        if (is_dir($pathname )) {system("rm -rf ".escapeshellarg($pathname));}
                        echo "Complete.".PHP_EOL;
                        // fwrite($myfile, $pathname."\n");
                        $logFile = '/var/www/html/elibrary/file_preview/logs/log.txt'; // Path to the log file
                 
                        // Create or open the log file in append mode
                        $fileHandle = fopen($logFile, 'a');
       
                        if ($fileHandle) {
                            // Create a DateTime object with the current time in UTC
                            $dateTime = new DateTime('now', new DateTimeZone('UTC'));
       
                            // Convert the DateTime object to the Bangkok timezone
                            $dateTime->setTimezone(new DateTimeZone('Asia/Bangkok'));
       
                            // Format the datetime string
                            $timeInBangkok = $dateTime->format('Y-m-d H:i:s');
       
                            $message = $timeInBangkok . "Staff File $bookid return successfully\n";
       
                            // Write the message to the log file
                            fwrite($fileHandle, $message);
       
                            // Close the file handle
                            fclose($fileHandle);
       
                            echo "Log entry added successfully.";
                        } else {
                            echo "Unable to open the log file.";
                        }

                         pg_query($db_connection,'update book set amountleft = amountleft + 1 Where bookid ='.$row['bookid']); 
                    
                    }
  
  echo PHP_EOL; 
  echo PHP_EOL; 
  

        $interval2 =  "select borrowstartdate,isreturn,bookid,A.userid from borrow A
        left join users B
        on A.userid = B.userid  
        Where 
        B.borrowlevelid = 2 
        And
        A.borrowstartdate <= now() - INTERVAL '".$interday2." DAYS'
        And
        A.isreturn = false
        order by A.bookid, A.borrowstartdate desc";

                $result = pg_query($db_connection, $interval2);
                while ($row = pg_fetch_array($result)) 
                {
                echo $row['bookid'].PHP_EOL;     
                echo $row['userid'].PHP_EOL;   
                
                
                $result_pass = pg_query($db_connection, "select uid from psu_passport where userid =".$row['userid']);                        
                $uid = pg_fetch_array($result_pass); 
                
                $pathname = "./files/".$row['bookid']."/".$uid["uid"];    
                 
                echo  $pathname.PHP_EOL;
                if (is_dir($pathname )) {system("rm -rf ".escapeshellarg($pathname));}
                echo "Complete.".PHP_EOL;
                // fwrite($myfile, $pathname."\n");
                 pg_query($db_connection,'update book set amountleft = amountleft + 1 Where bookid ='.$row['bookid']); 
                    

                 $logFile = '/var/www/html/elibrary/file_preview/logs/log.txt'; // Path to the log file
                 
                 // Create or open the log file in append mode
                 $fileHandle = fopen($logFile, 'a');

                 if ($fileHandle) {
                     // Create a DateTime object with the current time in UTC
                     $dateTime = new DateTime('now', new DateTimeZone('UTC'));

                     // Convert the DateTime object to the Bangkok timezone
                     $dateTime->setTimezone(new DateTimeZone('Asia/Bangkok'));

                     // Format the datetime string
                     $timeInBangkok = $dateTime->format('Y-m-d H:i:s');

                     $message = $timeInBangkok . " Student File $bookid File $bookid return successfully \n";

                     // Write the message to the log file
                     fwrite($fileHandle, $message);

                     // Close the file handle
                     fclose($fileHandle);

                     echo "Log entry added successfully.";
                 } else {
                     echo "Unable to open the log file.";
                 }
                }

//  pg_query($db_connection,'update book  set amountleft = amount where amountleft > amount');



$update1  = "update borrow 
             set isreturn = true
             FROM (select borrowstartdate,isreturn,bookid, A.userid from borrow A
				left join users B
				on A.userid = B.userid  
				Where 
				B.borrowlevelid = 1 
				And
				A.borrowstartdate <= now() - INTERVAL '14 DAYS'
				And
				A.isreturn = false
				order by A.userid, A.borrowstartdate desc) AS subquery
		      WHERE borrow.borrowstartdate = subquery.borrowstartdate;";
		
              pg_query($db_connection, $update1);

// $update2 = "update borrow 
//             set isreturn = true
//             FROM (select borrowstartdate,isreturn,bookid, A.userid from borrow A
// 				left join users B
// 				on A.userid = B.userid  
// 				Where 
// 				B.borrowlevelid = 2 
// 				And
// 				A.borrowstartdate <= now() - INTERVAL '".$interday2." DAYS'
// 				And
// 				A.isreturn = false
// 				order by A.userid, A.borrowstartdate desc) AS subquery
// 		    WHERE borrow.borrowstartdate = subquery.borrowstartdate;";

//             pg_query($db_connection, $update2); 

// fclose($myfile);

?>