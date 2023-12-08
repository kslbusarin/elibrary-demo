<?php
require_once "../../class/connect_db.php";
if (isset($_GET['term'])) {
     
   $query = "SELECT * FROM publisher WHERE publishername LIKE '{$_GET['term']}%' LIMIT 25";
   $result = pg_query($db_connection, $query);
 

   //Crate array parameter
   $arr = array();
        
   // Fetch data to array
   while ($row = pg_fetch_assoc($result)) {
        
        $arr[] = $row['publishername'];
   }
    echo json_encode($arr);
}
?>