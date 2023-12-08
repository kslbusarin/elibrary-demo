<?php
include("../backend/class/connect_db.php");
$uid = 0042150;
$bookid = 416;
// echo "Generate";
// echo $uid;
// echo $bookid;
$arr = array();
$sql = "select * from book where bookid = $bookid";
            $result = pg_query($db_connection, $sql);
            while ($row = pg_fetch_assoc($result)) {
                $arr[] = $row;
            }
            // echo $arr[0]["bookfileurl"];
            // Update viewcount
            // if($result){    
                // Directory path to be removed
                $directory = './files/416/0042150';
                // Remove the directory
                removeDirectory($directory);

            // }
            // else{
            //     $arr = ['empty'];
            // }
  
        // echo json_encode($arr);



// Function to remove directory recursively
function removeDirectory($directory) {
    if (!file_exists($directory)) {
        return;
    }

    $files = array_diff(scandir($directory), array('.', '..'));

    foreach ($files as $file) {
        $filePath = $directory . '/' . $file;

        if (is_dir($filePath)) {
            removeDirectory($filePath);
        } else {
            unlink($filePath);
        }
    }

    rmdir($directory);
}


?>
