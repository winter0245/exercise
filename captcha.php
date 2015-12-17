<?php
require 'captcha.class.php';
  session_start();
  $vc=new ValidateCode();
  $vc->doimg();
  $vcodes=$vc->getCode();
//生成验证码图片
Header("Content-type:image/PNG");

$_SESSION['Checknum'] = $vcodes;
?>