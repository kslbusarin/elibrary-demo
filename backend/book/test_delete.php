<?php

    ini_set('max_execution_time', '3600');
        
    // $clone_dir ="../../../demo6/pdf/".$bookid."/clone/";  //Same site
    $clone_dir ="http://192.168.27.15/demo6/pdf/308/clone/";   // Diff site
    $uid = "0042150";
    $pathname = $clone_dir.$uid."/";
    echo $pathname."<br>";
    if (is_dir($pathname)) {
        system("rm -rf ".escapeshellarg($pathname));
        echo "Delete complete";
    }
    else{
        echo "Error";
    }
?>