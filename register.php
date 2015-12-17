<?php
session_start();
require 'dao.php';
$username_error=$password_error=$repassword_error=$nicname_error=$captcha_error=$nicname=$error=null;
$username=$password=$repassword=$nicname=$captcha=$msg=null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = trim_input(filter_input(INPUT_POST, "username",FILTER_DEFAULT));
  $nicname = trim_input(filter_input(INPUT_POST, "nicname",FILTER_DEFAULT));
  $password = trim_input(filter_input(INPUT_POST, "password",FILTER_DEFAULT));
  $repassword = trim_input(filter_input(INPUT_POST, "repassword",FILTER_DEFAULT));
  $captcha = trim_input(filter_input(INPUT_POST, "Captcha",FILTER_DEFAULT));
  $flag=true;
  if(is_null($username)){
      $username_error="用户名不能为空";
      $flag=false;
  }
 else if(mysql_num_rows(findUserByUsername($username))>0){
       $username_error="用户名已存在";
         $flag=false;
  }
  if(is_null($password)){
      $password_error="密码不能为空";
         $flag=false;
  }
  else if($password!=$repassword){
      $repassword_error="密码不一致";
         $flag=false;
  }
  if($_SESSION["Checknum"]!=$captcha){
      $captcha_error="验证码输入有误";
        $flag=false;
  }
  if(is_null($nicname)){
      $nicname_error="昵称不能为空";
      $flag=false;
  }
  if($flag){
       $user=new User($username,$password,$nicname);
       $res=  addUser($user);
       if($res){
           $username_error=$password_error=$repassword_error=$nicname_error=$captcha_error=$nicname=$error=null;
$username=$password=$repassword=$nicname=$captcha=null;
           $msg="注册成功,请登录";
       }
       else{
           $msg="注册失败";
       }
  }
}
?>

<html>
    <!DOCTYPE html>
    <html lang="en" class="no-js">

        <head>
            <meta charset="utf-8">
            <title>Diary Register</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="">
            <meta name="author" content="">
            <link rel="stylesheet" href="assets/css/reset.css">
            <link rel="stylesheet" href="assets/css/supersized.css">
            <link rel="stylesheet" href="assets/css/style.css">
      
        </head>

        <body>
<?php
 
       
      
?>
           
            <div class="page-container">
             
                <h1>Diary Register</h1>
                <h2 style="margin-top: 15px"><?php echo $msg;?></h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                    <input type="text" name="username" class="username" placeholder="请输入您的用户名！" value="<?php echo $username;?>"><span style="color: red"><?php echo $username_error;?></span>
                    <input type="text" name="nicname" class="username" placeholder="请输入您的昵称！" value="<?php echo $nicname;?>"><span style="color: red"><?php echo $nicname_error;?></span>
                    <input type="password" name="password" class="password" placeholder="请输入您的用户密码！" value="<?php echo $password?>"><span style="color: red"><?php echo $password_error;?></span>
                    <input type="password" name="repassword" class="password" placeholder="请确认您的用户密码！" value="<?php echo $repassword?>"><span style="color: red"><?php echo $repassword_error;?></span><br>
                
                    <input type="Captcha" class="Captcha" name="Captcha" placeholder="请输入验证码！" value="<?PHP echo $captcha;?>"><img  title="点击刷新" src="./captcha.php" align="absbottom" onclick="this.src='captcha.php?'+Math.random();" style="margin-top: 18px;"></img><span style="color: red"><?php echo $captcha_error;?></span>
                    <button type="submit" class="submit_button">注册</button>
                    <button type="button" class="submit_button" onclick="document.location.href='index.php'">登录</button>
                    <div class="error"><span><?php echo $error?></span></div>
                </form>

            </div>

            <!-- Javascript -->
            <script src="assets/js/jquery-1.8.2.min.js" ></script>
            <script src="assets/js/supersized.3.2.7.min.js" ></script>
            <script src="assets/js/supersized-init.js" ></script>
            <script src="assets/js/scripts.js" ></script>

        </body>
        <div style="text-align:center;">

        </div>
        
     <script type="text/javascript" src="./js/jquery.js"></script>
     <script type="text/javascript" src="./js/webuploader.js"></script>
     <script type="text/javascript" src="./webupload/js/cropper.js"></script>
     <script type="text/javascript" src="./webupload/js/uploader.js"></script>
       
    </html>
