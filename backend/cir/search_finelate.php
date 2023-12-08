<?php
    //กำหนดค่า Access-Control-Allow-Origin ให้ เครื่อง อื่น ๆ สามารถเรียกใช้งานหน้านี้ได้
    header("Access-Control-Allow-Origin: *");
    
    header("Content-Type: application/json; charset=UTF-8");
    
    header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
    
    header("Access-Control-Max-Age: 3600");
    
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    //ตั้งค่าการเชื่อมต่อฐานข้อมูล
    include("../class/connect_orcl.php");
 
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    $patron_barcode = $_POST["uid"];
        if($requestMethod == 'POST'){
            $sql = "select ITEM_NO
            ,ITEM_BARCODE
            ,TITLE
            ,COLLECTION_THAI
            ,PATRON_BARCODE
            ,PATRON_NAME
            ,PATRON_TYPE_THAI
            ,FAC_THAI
            ,DEPT_THAI
            ,TO_CHAR(CHECKOUT_DATETIME, 'DD MON YYYY HH24:MI:SS') as CHECKOUT_DATETIME_RE
            ,RENEW_DATETIME
            ,DUE_DATETIME
            ,CHECKIN_DATETIME
            ,OFFICER_CHECKOUT
            ,DEBT_TYPE_THAI
            ,FINE_AMOUNT
            from v_cir_latefine
            where debt_type_thai = 'ค่าปรับเกินกำหนดส่ง'
            and checkout_datetime is not null
            and branch_code = 'PSUCL'
            and patron_barcode = '6210210562'
            order by checkout_datetime desc
            FETCH FIRST 50 ROWS ONLY";

        
            $stid = oci_parse($conn, $sql);
            oci_execute($stid);
            
            // //สร้างตัวแปร array สำหรับเก็บข้อมูลที่ได้
            $arr = array();
            while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
                $arr[] = $row;
                // echo  $row["TITLE"];
            }
            // echo $arr;
            echo json_encode($arr);
            // $data = file_get_contents("php://input");
        
            //แปลงข้อมูลที่อ่านได้ เป็น array แล้วเก็บไว้ที่ตัวแปร result
            // $result = json_decode($data,true);
        //  }

            
        }
