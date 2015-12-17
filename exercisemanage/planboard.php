<?php
   session_start();
      require './../dao.php';
if(!isset($_SESSION["user"])){
    header("location:../index.php");
}
$user= $_SESSION["user"];
        ?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="../js/jquery-2.1.1.min.js"></script>
        <meta name="renderer" content="webkit">
        <link href="../css/bootstrap.min.css?v=3.4.0" rel="stylesheet">
        <link href="../font-awesome/css/font-awesome.css?v=4.3.0" rel="stylesheet">

        <link href="../css/animate.css" rel="stylesheet">
        <link href="../css/style.css?v=2.2.0" rel="stylesheet">
        <script >
        function delplan(id){
            var flag=confirm('确认删除id为'+id+"的计划吗?");
            if(flag){
               $.post("../interface/backinterface.php",
  {
    method:"delExercisePlan",
    planid:id
  },
  function(data,status){
      if(data&&status=='success'){
          $('#'+id).remove();
      }
      else{
          alert('删除失败');
      }
  });
               // $('#'+id).remove();
            }
            else{
                alert('取消删除');
            }
        }
        </script>
        
        <title>健身计划墙</title>
    </head>
 <body style="background:#fff;">
     

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-9">
                <h2>健身计划墙</h2><br>
                <h3><a href="addplan.php">添加计划</a></h3>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInUp">
                    <ul class="notes">
                        <?php
                        $plans= queryAllExercisePlan($user["id"]);
                        $count=  count($plans);
                        for($i=0;$i<$count;$i++){
                            $plan=$plans[$i];
                            echo '<li>';
                            echo '<div id=\''.$plan['id'].'\'>';
                            echo '<small>'.$plan['addtime'].'</small>';
                            echo '<h4>'.$plan["title"].'</h4>';
                            echo '<p>'.$plan["content"].'</p>';
                            echo " <a href=\"javascript:delplan(".$plan["id"].")\"><i class='fa fa-trash-o'></i></a>";
                            echo '</div>';
                            echo '</li>';
                        }

                    ?>

                    </ul>
                </div>
            </div>
        </div>


        <script src="../js/jquery-2.1.1.min.js"></script>
        <script src="../js/bootstrap.min.js?v=3.4.0"></script>
        <script src="../js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="../js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

        <!-- Custom and plugin javascript -->
        <script src="../js/hplus.js?v=2.2.0"></script>
        <script src="../js/plugins/pace/pace.min.js"></script>



    </body>
</html>
