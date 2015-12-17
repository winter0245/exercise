<?php 
 require 'dao.php';
session_start();
      if(isset($_SESSION["user"])&&$_SESSION["user"]!=null){
            header("location:userindex.php");
      }
$checkcode=null;
if(isset($_SESSION['Checknum'])){
    $checkcode=$_SESSION['Checknum'];
}
$username_error=$password_error=$captcha_error=null;
$flag=true;
$password=trim_input(filter_input(INPUT_POST, "password"));
        $username=trim_input(filter_input(INPUT_POST, "username"));
         $captcha=trim_input(filter_input(INPUT_POST, "Captcha"));
if($_SERVER["REQUEST_METHOD"] == "POST"){if(is_null($username)){
    $username_error="用户名不能为空";
    $flag=false;
}
if(is_null($password)){
    $password_error="密码不能为空";
    $flag=false;
}
if(is_null($captcha)||$checkcode!=strtolower($captcha)){
    $captcha_error="验证码输入有误";
    $flag=false;
}
if($flag){
    if(checkLogin($username, md5($password))){
        $user= mysql_fetch_array(findUserByUsername($username));
        $_SESSION["user"]=$user;
     header("location:userindex.php");
    }
    else{
        $username_error="用户名或密码输入有误";
    }
}
}
  $weekday=array("星期一","星期二","星期三","星期四","星期五","星期六","星期天");
  $weekdate=$weekday[date("N")-1];
?>
<html>
    <!DOCTYPE html>
    <html lang="en" class="no-js">

        <head>

            <meta charset="utf-8">
            <title>Diary Login</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="">
            <meta name="author" content="">

            <!-- CSS -->
            <link rel="stylesheet" href="assets/css/reset.css">
            <link rel="stylesheet" href="assets/css/supersized.css">
            <link rel="stylesheet" href="assets/css/style.css">

            <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
            <!--[if lt IE 9]>
                <script src="assets/js/html5.js"></script>
            <![endif]-->

        </head>

        <body>
     <h2 style="text-align: right"><?php echo  date("Y年-m月-d日 ") .$weekdate. "<br>";?></h2>
            <div class="page-container">
            
                <h1>Diary Login</h1>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                    <input type="text" name="username" class="username" placeholder="请输入您的用户名！" value="<?php echo $username;?>"><span style="color: red"><?php echo $username_error;?></span>
                    <input type="password" name="password" class="password" placeholder="请输入您的用户密码！" value="<?php echo $password?>"><span style="color: red"><?php echo $password_error;?></span>
                    <input type="Captcha" class="Captcha" name="Captcha" placeholder="请输入验证码" value="<?PHP echo $captcha;?>"><img  title="点击刷新" src="./captcha.php" align="absbottom" onclick="this.src='captcha.php?'+Math.random();" style="margin-top: 18px;"></img><span style="color: red"><?php echo $captcha_error;?></span>
                    <button type="submit" class="submit_button">登录</button>  <button type="button" class="submit_button" onclick="document.location.href='register.php'">注册</button>
                  
                </form>

            </div>

            <!-- Javascript -->
            <script src="assets/js/jquery-1.8.2.min.js" ></script>
            <script src="assets/js/supersized.3.2.7.min.js" ></script>
            <script src="assets/js/supersized-init.js" ></script>
            <script src="assets/js/scripts.js" ></script>

        </body>
        <div style="text-align:center;">
<?php 

?>
        </div>
        
     
      <?php include 'footer.php';?> 
    </html>
