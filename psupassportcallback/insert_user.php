<?php
session_start();
//Define Access-Control-Allow-Origi
header("Access-Control-Allow-Origin: *");

header("Content-Type: application/json; charset=UTF-8");

header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");

header("Access-Control-Max-Age: 3600");

header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include("../backend/class/connect_db.php");

$arr = array();
$get_userid = 0;
//SQL where id
// echo  $_POST['bookBookId'];
// if(isset($_POST['username']) && !empty($_POST['username'])){
    // get bookID and Userid
   // Prepare the SQL statement
    $sql = "INSERT INTO public.users(roleid, borrowlevelid, userid_old, roleroleid_old, borrowlevelborrowlevelid_old) VALUES ($1, $2, $3, $4, $5)";



    // Prepare the parameters
    $roleid = 1;
    $userid_old = '';
    $roleroleid_old = 0;
    $borrowlevelborrowlevelid_old = 0;
    $activate = 1; 
    $department = $_POST['department']; 
    $department_id = $_POST['department_id']; 
    $email = $_POST['email']; 
    $faculty = $_POST['faculty']; 
    $faculty_id = $_POST['faculty_id']; 
    $fullname = $_POST['fullname']; 
    $fullname_en = $_POST['fullname_en']; 
    $login = $_POST['login'];
    $status = "OK";

    if($_POST["typeperson"]=="3"){
        $type = 'Students'; 
        $borrowlevelid = 2;
    }
    elseif($_POST["typeperson"]=="2"){
        $type = 'Staffs'; 
        $borrowlevelid = 1;
    }
    else{
        $type = null; 
    }
    
    $uid = $_POST['username']; 
    $userid = $get_userid; 
    $useruserid_ol = ''; 

    // Execute the statement with parameters
    $result = pg_query_params($db_connection, $sql, array($roleid, $borrowlevelid, $userid_old, $roleroleid_old, $borrowlevelborrowlevelid_old));

    if (!$result) {
        die("Error in SQL query: " . pg_last_error());
    }
    else{
        $sql = "select * from users order by userid desc limit 1";
    
        $result = pg_query($db_connection, $sql);
        $rows = pg_num_rows($result);
        if ($rows==1) {
            while ($row = pg_fetch_assoc($result)) {
                        $arr[] = $row;
                        $get_userid = $row["userid"];
            }

            

            $sql = "INSERT INTO public.psu_passport(
                activate, department, department_id, email, faculty, faculty_id, fullname, fullname_en, login, status, type, uid, userid, useruserid_old)
                VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13, $14);";

        
            // Execute the statement with parameters
            $result = pg_query_params($db_connection, $sql, array($activate, $department, $department_id, $email, $faculty,
            $faculty_id, $fullname, $fullname_en, $login, $status, $type, $uid, $get_userid, $useruserid_ol));

            if (!$result) {
                die("Error in SQL query: " . pg_last_error());
            }
            else{
                $result = array("status"=> "success");
            }
        }
        else{

        }    
    }
    
    // Close the database connection
    pg_close($db_connection);
    echo json_encode($result);
// }


?>
