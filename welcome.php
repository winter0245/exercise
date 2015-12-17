<?php
session_start();
if(!isset($_SESSION["user"])){
    header("location:index.php");
}

?>
<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">

    <title>个人中心</title>
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Morris -->
    <link href="./css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="./js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

    <link href="./css/animate.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
      <style type="text/css">
         body {background:url(./img/background.jpg) ;
               height: 662px;
               width: 970px;
                background-repeat: no-repeat;
         }
        
    </style>
    </head>
    <body >
       
    </body>
</html>
