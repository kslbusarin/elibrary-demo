<?php
    //กำหนดค่า Access-Control-Allow-Origin ให้ เครื่อง อื่น ๆ สามารถเรียกใช้งานหน้านี้ได้
    header("Access-Control-Allow-Origin: *");
    
    header("Content-Type: application/json; charset=UTF-8");
    
    header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
    
    header("Access-Control-Max-Age: 3600");
    
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    //ตั้งค่าการเชื่อมต่อฐานข้อมูล
    include("../class/connect_orcl.php");




        //  if(!empty($result)){
            // $sql = "select * from ALIST01.ITEM_REC FETCH FIRST 100 ROWS ONLY";

            $sql = "select  bb.barcode, bb.patron_name, aa.barcode as ItemBarcode,
            blib.title,aa.CHKOUT_DATETIME,
            TO_CHAR (aa.CHKOUT_DATETIME, 'DD MON YYYY HH24:MI:SS') as Checkout,
            TO_CHAR (aa.DUE_DATETIME, 'DD MON YYYY') as Due,
            TO_CHAR (aa.CHKIN_DATETIME, 'DD MON YYYY') as CheckIn
            from ALIST01.ITEM_REC aa
            join ALIST01.patron_rec bb
            on aa.patron_no = bb.patron_no
            join ALIST01.BIB_LIMIT blib
            on aa.bib_no = blib.bib_no
            where aa.CHKOUT_DATETIME >= TO_DATE('26/10/2022 00:00:00', 'dd/mm/yyyy HH24:MI:SS') 
            and  aa.CHKOUT_DATETIME <= TO_DATE('26/10/2022 23:59:00', 'dd/mm/yyyy HH24:MI:SS') 
            and aa.BRANCH_CODE = 'PSUCL'
            order by  CHECKIN desc ,CHKOUT_DATETIME DESC
            FETCH FIRST 500 ROWS ONLY";

        
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
            

