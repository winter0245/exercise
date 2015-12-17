<?php require './../dao.php';?>


<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $json= json_encode(findExerciseTypes());
        ?>
        <script type="text/javascript">
            var json=eval('(<?php echo $json?>)');
   for(var o in json){
       alert(json[o].typename);
       
   }
        </script>
    </body>
</html>
