<?php
require './../dao.php';
session_start();
if(!isset($_SESSION["user"])){
    header("location:index.php");
}
$user= $_SESSION["user"];
$res=  queryAllExerciseData($user["id"]);
$json=json_encode($res);
$str=preg_replace("#\\\u([0-9a-f]{4})#ie", "iconv('UCS-2BE', 'UTF-8', pack('H4', '\\1'))", $json);
echo   $str;





