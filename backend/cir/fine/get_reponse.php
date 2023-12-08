<?php

$post_data_expected = file_get_contents("php://input");

$decoded_data = json_decode($post_data_expected, true);

var_dump($decoded_data);

$myfile = fopen("trans.txt", "a") or die("Unable to open file!");

fwrite($myfile, print_r($decoded_data, true));
fclose($myfile);

include("../../class/connect_payment.php");
// $post_data_expected = '{ "customer": "John Doe", "items": {"product": "Beer","qty": 6}}';
$sql = "insert into public.transaction(
    id, gateway, method, description, metadata, created)
    VALUES (uuid_generate_v4(),'scb', 'qrpayment', 'test', '$post_data_expected', now())";
    // VALUES (uuid_generate_v4(),'scb', 'qrpayment', 'test', '{ "customer": "John Doe", "items": {"product": "Beer","qty": 6}}', now())";
$result = pg_query($db_connection, $sql);
if ($result) {
    $status =  "Payment is successfully";
    echo $status;
    // array_push($status_all, array("state" => True));
    // array_push($status_all, array("state_borrow" => $status));
} 
else {
    $status =  "User must have sent wrong Payment";
    echo $status;
    // array_push($status_all, array("state" => False));

    //         array_push($status_all, array("state_borrow" => $quota_borrow));
        

    //         array_push($status_all, array("state_borrow" => $sum_available_book));
}


?>
