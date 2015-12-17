<?php
require './../dao.php';
  $method=  trim_input(filter_input(INPUT_POST, "method"));

  switch ($method) {
    case "delExercisePlan":
        $planid=trim_input(filter_input(INPUT_POST, "planid"));
        delExercisePlanService($planid);
          break;

    default:
        break;
}
  
  
  function delExercisePlanService($planid){
     $res= delExercisePlan($planid);
     if($res){
         echo 'true';
     }
     else{
         echo 'false';
     }
  }
  
?>
