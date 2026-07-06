<?php
        // Report all PHP errors
        error_reporting(E_ALL);

        // Force errors to be displayed on the screen
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);

//                     ที่อยู่ db,   username, รหัส,  ชื่อ db
$con = mysqli_connect("localhost", "root", "", "manrood_db");

// ทดสอบการเชื่อมต่อ
// ถ้าสำเร็จ $con จะ != false 
// ไม่สำเร็จ $con จะ = false 
// if(!$con){
//     die("เชื่อมต่อไม่สำเร็จ");
// }
// echo "เชื่อมต่อสำเร็จ";
