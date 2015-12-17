<?php

ini_set('date.timezone', 'Asia/Shanghai');

function getServerInfo() {
    $configary = parse_ini_file("config/mysql.ini");
    return $configary;
}

function trim_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function addUser(User $user) {
    $sql = "INSERT INTO `user` (`username`, `password`, `nicname`, `lastlogin`) VALUES ('" . $user->getUsername() . "', '" . $user->getPassword() . "', '" . $user->getNicname() . "', '" . date('Y-m-d G:i:s') . "')";
    return querySql($sql);
}

function findUserByUsername($username) {
    $sql = "select * from `user` where username='" . $username . "'";
    return querySql($sql);
}

function checkLogin($username,$password){
    $res=  findUserByUsername($username);
    if(mysql_num_rows($res)==0){
        return false;
    }
    else{
        $user=mysql_fetch_array($res);
        if($user["password"]==  $password){
            return true;
        }
        else{
            return false;
        }
    }
}

function findExerciseTypes(){
    $sql="select * from exercisetype";
    $res=  querySql($sql);
    $array=array();
    if($res){
        while ($row = mysql_fetch_array($res,MYSQL_ASSOC)) {
            $array[$row["id"]]=$row;
        }
    }
    return $array;
}

function findExerciseTypeById($typeid){
    $typeid=  trim_input($typeid);
    $sql="select * from exercisetype where id=".$typeid;
    $res=  querySql($sql);
    if($res){
        return mysql_fetch_array($res,MYSQL_ASSOC);
    }
    return null;
}

function addExercieRecord($typeid,$count,$totaltime,$date,$comment,$userid){
    $uid=  intval($userid);
    $type=  findExerciseTypeById($typeid);
    $sql="INSERT INTO `exercise_record` (`userid`,`type`, `count`, `unit`, `totaltime`, `date`,`comment`) VALUES (".$uid.",'".$type["typename"]."',".$count.",'".$type["unit"]."', '".$totaltime."', '".$date."','".$comment."')";
    $res=  querySql($sql);
    return $res;
}



/*添加健身计划*/
function addExecisePlan($userid,$title,$content){
    $status=0;//初始化为未完成状态
    $addtime=date("Y-m-d h:i:s");
  $sql="INSERT INTO `exercise_plan` (`userid`, `title`, `content`, `addtime`, `status`) VALUES (".$userid.",'".$title."','".$content."', '".$addtime."', ".$status.")";
 $res=  querySql($sql);
    return $res;
}

/*删除健身计划*/
function delExercisePlan($planid){
    $id=  intval($planid);
    $sql="delete from `exercise_plan` where id=".$id;
    $res=  querySql($sql);
    return $res;
    
}
/*查询健身记录*/
function queryAllExerciseData($userid){
    $uid=  intval($userid);
    $sql="select * from `exercise_record` where userid=".$uid;
    $ary=array();
    $res=  querySql($sql);
     if($res){
      
        while($row=mysql_fetch_array($res,MYSQL_ASSOC)){
            array_push($ary, $row);
        }
    }
    return $ary;
}

/*查询所有健身计划*/
    function queryAllExercisePlan($userid){
           $uid=  intval($userid);
    $sql="select * from `exercise_plan` where userid=".$uid;
    $ary=array();
    $res=  querySql($sql);
     if($res){
      
        while($row=mysql_fetch_array($res,MYSQL_ASSOC)){
            array_push($ary, $row);
        }
    }
    return $ary;
    }


function querySql($sql) {
    $dbConfig = getServerInfo();
    $con = mysql_connect($dbConfig['host'], $dbConfig["username"], $dbConfig['password']);
    if (!$con) {
        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db($dbConfig["database"]);
    mysql_query("set names utf8", $con);
    $res = mysql_query($sql, $con);
    mysql_close($con);
    return $res;
}

class User {

    private $username;
    private $password;
    private $nicname;
    private $lastlogin;
    private $id;

    function __construct($username, $password, $nicname) {
        $this->username = $username;
        $this->password = md5($password);
        $this->nicname = $nicname;
    }

    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }

    function getNicname() {
        return $this->nicname;
    }

    function getLastlogin() {
        return $this->lastlogin;
    }

    function getId() {
        return $this->id;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setNicname($nicname) {
        $this->nicname = $nicname;
    }

    function setLastlogin($lastlogin) {
        $this->lastlogin = $lastlogin;
    }

    function setId($id) {
        $this->id = $id;
    }

 
}
    

