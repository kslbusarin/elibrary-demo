<?php

// $post_data_expected = file_get_contents("php://input");

// $decoded_data = json_decode($post_data_expected, true);

// var_dump($decoded_data);

// $myfile = fopen("trans.txt", "a") or die("Unable to open file!");

// fwrite($myfile, print_r($decoded_data, true));
// fclose($myfile);

include("../class/connect_payment.php");

$post_data_expected = '{
    "amount": "50",
    "payeeName": "TestBiller1667275737",
    "payerName": "Sutdarat Joisook",
    "channelCode": "PMH",
    "currencyCode": "764",
    "payeeProxyId": "249380490386491",
    "payerProxyId": "8057300001",
    "transactionId": "202212073WjZwV4OnTKGd08",
    "payeeProxyType": "BILLERID",
    "payerProxyType": "ACCOUNT",
    "billPaymentRef1": "123124",
    "billPaymentRef2": "34534534",
    "billPaymentRef3": "SCB",
    "sendingBankCode": "014",
    "transactionType": "Domestic Transfer",
    "receivingBankCode": "014",
    "payeeAccountNumber": "0987654321",
    "payerAccountNumber": "8057300001",
    "transactionDateandTime": "2022-12-07T10:21:12+07:00"
}';

$payment_scb = guidv4();
$payment_event = guidv4();
insert_transaction($db_connection, $post_data_expected, $payment_scb, $payment_event);
$decoded_data = json_decode($post_data_expected, true);
// var_dump($post_data_expected);
// echo $decoded_data["amount"];

function insert_transaction($db_connection,$post_data_expected, $payment_scb, $payment_event){
    
    $decoded_data = json_decode($post_data_expected, true);
    $amount = $decoded_data["amount"];
    $payeeName  = $decoded_data["payeeName"];
    $payerName = $decoded_data["payerName"];
    $channelCode = $decoded_data["channelCode"];
    $currencyCode = $decoded_data["currencyCode"];
    $payeeProxyId = $decoded_data["payeeProxyId"];
    $payerProxyId = $decoded_data["payerProxyId"];
    $transactionId = $decoded_data["transactionId"];
    $payeeProxyType = $decoded_data["payeeProxyType"];
    $payerProxyType = $decoded_data["payerProxyType"];
    $billPaymentRef1 = $decoded_data["billPaymentRef1"];
    $billPaymentRef2 = $decoded_data["billPaymentRef2"];
    $billPaymentRef3 = $decoded_data["billPaymentRef3"];
    $sendingBankCode = $decoded_data["sendingBankCode"];
    $transactionType = $decoded_data["transactionType"];
    $receivingBankCode = $decoded_data["receivingBankCode"];
    $payeeAccountNumber = $decoded_data["payeeAccountNumber"];
    $payerAccountNumber = $decoded_data["payerAccountNumber"];
    $transactionDateandTime = $decoded_data["transactionDateandTime"];


    $sql = "insert into public.transaction(
        id, gateway, method, description, metadata, created)
        VALUES ('$payment_scb','scb', 'qrpayment', 'test', '$post_data_expected', now())";
        // VALUES (uuid_generate_v4(),'scb', 'qrpayment', 'test', '{ "customer": "John Doe", "items": {"product": "Beer","qty": 6}}', now())";
    $result_payment = pg_query($db_connection, $sql);
    if ($result_payment) {
        $status =  "Payment is successfully";
        echo $status;
        // prepare and bind
        
            $sql = "INSERT INTO public.transaction_event(
                id, transaction_id, type, amount, payeename, payername, channelcode, currencycode, 
                payeeproxyid, payerproxyid, transactionid, payeeproxytype, payerproxytype, billpaymentref1, 
                billpaymentref2, billpaymentref3, sendingbankcode, transactiontype, receivingbankcode, 
                payeeaccountnumber, payeraccountnumber, transactiondateandtime, created)
                VALUES ('$payment_event', '$payment_scb', '1', $1, $2, $3, $4, $5, 
                $6, $7, $8, $9, $10, $11,
                $12, $13, $14, $15, $16, 
                $17, $18, $19, now())";
            pg_prepare($db_connection,'my_insert', $sql) or die ("Cannot prepare statement1\n") ;
            pg_execute($db_connection,'my_insert', array(
                        $amount,
                        $payeeName,
                        $payerName ,
                        $channelCode,
                        $currencyCode ,

                        $payeeProxyId ,
                        $payerProxyId ,
                        $transactionId,
                        $payeeProxyType,
                        $payerProxyType,
                        $billPaymentRef1,

                        $billPaymentRef2,
                        $billPaymentRef3,
                        $sendingBankCode,
                        $transactionType,
                        $receivingBankCode,

                        $payeeAccountNumber,
                        $payerAccountNumber,
                        $transactionDateandTime
                )) or die ("Cannot execute statement1\n");
            
        //     $stmt->bind_param("sss", 
        //     $amount,
        //     $payeeName,
        //     $payerName ,
        //     $currencyCode ,
        //     $payeeProxyId ,
        //     $payerProxyId ,
        //     $transactionId,
        //     $payeeProxyType,
        //     $payerProxyType,
        //     $billPaymentRef1,
        //     $billPaymentRef2,
        //     $billPaymentRef3,
        //     $sendingBankCode,
        //     $transactionType,
        //     $receivingBankCode,
        //     $payeeAccountNumber,
        //     $payerAccountNumber,
        //     $transactionDateandTime
        
        // );


        // $result2 = pg_execute($db_connection, "ss", array(
        //     $amount,
        //     $payeeName,
        //     $payerName ,
        //     $currencyCode ,
        //     $payeeProxyId ,
        //     $payerProxyId ,
        //     $transactionId,
        //     $payeeProxyType,
        //     $payerProxyType,
        //     $billPaymentRef1,
        //     $billPaymentRef2,
        //     $billPaymentRef3,
        //     $sendingBankCode,
        //     $transactionType,
        //     $receivingBankCode,
        //     $payeeAccountNumber,
        //     $payerAccountNumber,
        //     $transactionDateandTime)
        // );
            // set parameters and execute
                // $firstname = "John";
                // $lastname = "Doe";
                // $email = "john@example.com";
                // $stmt->execute();

        
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

}


function guidv4($data = null) {
    // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
    $data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);

    // Set version to 0100
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // Set bits 6-7 to 10
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    // Output the 36 character UUID.
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}
?>
