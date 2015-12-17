<!DOCTYPE html>

<?php
require 'dao.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        <form action="uploadfile.php" method="post"
enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="file" id="file" /> 
<br />
<input type="submit" name="submit" value="Submit" />
</form>
        
        
        <?php 
ini_set('date.timezone','Asia/Shanghai');
//$user=new User("winter","12345","winter木风");
//$res=  addUser($user);
//if($res){
//    echo '数据插入成功';
//}
//else{
//    echo '数据插入失败';    
//}
$res=  findUserByUsername("winter");
echo mysql_num_rows($res);
while ($row = mysql_fetch_array($res)) {
    echo $row['nicname'];
}
?>
    </body>
</html>
