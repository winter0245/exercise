<?php
require './../dao.php';
session_start();
if(!isset($_SESSION["user"])){
    header("location:../index.php");
}
$user= $_SESSION["user"];

$res=false;
$flag="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title=  trim_input(filter_input(INPUT_POST, "title"));
    $content= trim_input(filter_input(INPUT_POST, "plancontent"));
  
    $res=addExecisePlan($user["id"], $title, $content);
  
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
            <h5>添加健身计划</h5>

        </div>
        <div class="ibox-content">
            <form class="form-horizontal m-t" id="addrecordForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
               

                
                
                
                
                <div class="form-group">
                    <label class="col-sm-3 control-label">标题：</label>
                    <div class="col-sm-8">
                        <input id="title" name="title" class="form-control" type="text"  placeholder="输入计划标题">
                    </div>
                </div>
                
                
                 <div class="form-group">
                                        <label class="col-sm-3 control-label">说明：</label>
                                        <div class="col-sm-8">
                                            <textarea id="plancontent" name="plancontent" class="form-control" rows="5" cols="12" placeholder="输入计划内容" ></textarea>
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
                    title: {required: true,
                        maxlength:12
                    },
                   
                    plancontent: {
                        required: true,
                      maxlength:100
                    }
                  
                
                },
                messages: {
            
                    title: {
                        required: "请输入您的运动计划标题",
                        maxlength:"标题字符不能超过12个"
                    },
                    plancontent: {
                        required: "请输入您的运动计划内容",
                         maxlength:"内容字数不能超过100个"
                      
                    }
                }
            });

            // propose username by combining first- and lastname
           
        });    
             var flag='<?php echo $flag?>';
             var res='<?php echo $res?>';

             if(flag!==''){
                 if(res){
                  
                      toastr.success('Success', '计划添加成功!');
                 }
                 else{
                     toastr.error('Error','计划添加失败');
                 }
             }
    </script>
</body>
</html>