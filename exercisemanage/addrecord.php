<?php
require './../dao.php';
session_start();
if(!isset($_SESSION["user"])){
    header("location:../index.php");
}
$user= $_SESSION["user"];
$types = findExerciseTypes();
$res=false;
$flag="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $typeid=  trim_input(filter_input(INPUT_POST, "typeid"));
    $count= trim_input(filter_input(INPUT_POST, "num"));
     $totaltime=  trim_input(filter_input(INPUT_POST, "totaltime"));
    $date=trim_input(filter_input(INPUT_POST, "date"));
      $comment=trim_input(filter_input(INPUT_POST, "comment"));
    $res=addExercieRecord($typeid, $count, $totaltime, $date,$comment,$user["id"]);
  
   if($res){
       $flag="记录添加成功";
   }
   else{
       $flag="记录添加失败";
   }
}  
    
?>
<html>
    <head>
        <meta charset="utf-8">
        <link href="../css/bootstrap.min.css?v=3.4.0" rel="stylesheet">
        <link href="../font-awesome/css/font-awesome.css?v=4.3.0" rel="stylesheet">
        <link href="../css/animate.css" rel="stylesheet">
       
        
        
        <link href="../css/plugins/toastr/toastr.min.css" rel="stylesheet">
        <script src="../js/jquery-2.1.1.min.js"></script>
        <script src="../js/bootstrap.min.js?v=3.4.0"></script>
        <script src="../js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="../js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="../js/hplus.js?v=2.2.0"></script>
        <script src="../js/plugins/pace/pace.min.js"></script>
        <script src="../js/plugins/validate/jquery.validate.min.js"></script>
  
        <script src="../js/plugins/validate/messages_zh.min.js"></script>
        <script src="../js/plugins/layer/laydate/laydate.js"></script>
        
         <script src="../js/plugins/toastr/toastr.min.js"></script>
        
        <style type="text/css">
            .laydate_box, .laydate_box * {
                box-sizing:content-box;
            }
        </style>
        <script type="text/javascript">
             var exerciseType=eval('(<?php echo json_encode($types);?>)');
         
               function getType(){
            var selectid=$("#type option:selected").val();
            var unit=exerciseType[selectid].unit;
           $('#unit').attr('placeholder',unit);
          
        } 
     $(function(){
         getType();
         
         
     });
  
        </script>

    </head>
<body style="background:#fff;">
        <div class="ibox-title">
            <h5>添加健身记录</h5>

        </div>
        <div class="ibox-content">
            <form class="form-horizontal m-t" id="addrecordForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                <div class="form-group">
                    <label class="col-sm-3 control-label">日期：</label>
                    <div class="col-sm-8">
                        <input id="date" class="laydate-icon" class="form-control" type="text" class="valid" aria-required="true" name="date">

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">类型：</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="typeid" aria-required="true" aria-invalid="false" class="valid" id="type" onchange="getType()">
                            <?php
                            foreach ($types as $type) {
                                echo '<option value='.$type['id'].'>'.$type['typename'].'</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                
                
                
                
                <div class="form-group">
                    <label class="col-sm-3 control-label">计量单位：</label>
                    <div class="col-sm-8">
                        <input id="unit" name="unit" class="form-control" type="text" disabled="" placeholder="">
                    </div>
                </div>
                
                  <div class="form-group">
                    <label class="col-sm-3 control-label">数量：</label>
                    <div class="col-sm-8">
                        <input id="num" name="num" class="form-control" type="text"  placeholder="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">运动时间：</label>
                    <div class="col-sm-8">
                        <input id="totaltime" name="totaltime" class="form-control" type="text" aria-required="true" aria-invalid="true" class="error" placeholder="以分钟计算">
                    </div>
                </div>
                 <div class="form-group">
                                        <label class="col-sm-3 control-label">说明：</label>
                                        <div class="col-sm-8">
                                            <textarea id="ccomment" name="comment" class="form-control" rows="5" ></textarea>
                                        </div>
                                    </div>
             
                <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-3">
                        <button class="btn btn-primary" type="submit">提交</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <script type="text/javascript">
        laydate.skin('danlan');
        laydate({
            elem: '#date', //目标元素。由于laydate.js封装了一个轻量级的选择器引擎，因此elem还允许你传入class、tag但必须按照这种方式 '#id .class'
            event: 'focus' //响应事件。如果没有传入event，则按照默认的click
        });

        //以下为修改jQuery Validation插件兼容Bootstrap的方法，没有直接写在插件中是为了便于插件升级
        $.validator.setDefaults({
            highlight: function (element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function (element) {
                element.closest('.form-group').removeClass('has-error').addClass('has-success');
            },
            errorElement: "span",
            errorClass: "help-block m-b-none",
            validClass: "help-block m-b-none"


        });

        //以下为官方示例
        $().ready(function () {
            // validate the comment form when it is submitted


            // validate signup form on keyup and submit
            $("#addrecordForm").validate({
                rules: {
                    date: {required: true
                    },
                    lastname: "required",
                    totaltime: {
                        required: true
                      
                    },
                    num: {
                        required: true
                    }
                   
                
                },
                messages: {
                    date: "请选择日期",
           
                    totaltime: {
                        required: "请输入您的运动总时间",
                    },
                    num: {
                        required: "请输入您的运动数量",
                      
                    }
                }
            });

            // propose username by combining first- and lastname
           
        });
        
        
       
        
             var flag='<?php echo $flag?>';
             var res='<?php echo $res?>';
             if(flag!=''){
                 if(res){
                      toastr.success('Success', '记录添加成功!');
                 }
                 else{
                     toastr.error('Error','记录添加失败');
                 }
             }
    </script>
</body>
</html>