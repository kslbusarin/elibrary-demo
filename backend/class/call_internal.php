<?php
    //Define Access-Control-Allow-Origi
    header("Access-Control-Allow-Origin: *");
    
    header("Content-Type: application/json; charset=UTF-8");
    
    header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
    
    header("Access-Control-Max-Age: 3600");
    
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // echo $_SERVER['HTTP_REFERER'];
    $my_ip = getenv('HTTP_CLIENT_IP')?:
    getenv('HTTP_X_FORWARDED_FOR')?:
    getenv('HTTP_X_FORWARDED')?:
    getenv('HTTP_FORWARDED_FOR')?:
    getenv('HTTP_FORWARDED')?:
    getenv('REMOTE_ADDR');
    // echo $my_ip;
    // echo "<br>";
    $result = [];

    $ip_internal = ['192.168', '172.16',
                    '172.17', '172.18', '172.19',
                    '172.20', '172.21', '172.22',
                    '172.23', '172.24', '172.25',
                    '172.26', '172.27', '172.28',
                    '172.29', '172.30', '172.31'];
        
    $pre_ip = explode(".", $my_ip);
    if($pre_ip[0]=="10"){
        // echo $pre_ip[0]; 
        $result = array("result"=> true);
        // echo "<br>True";
    }
    else if (in_array($pre_ip[0].".".$pre_ip[1], $ip_internal)) {
        // echo $pre_ip[0].".".$pre_ip[1]; 
        $result = array("result"=> true);
        // echo "<br>True";
    }
    else{
        $result = array("result"=> false);
        // echo "False";
    }
    
    echo json_encode($result);
?>

