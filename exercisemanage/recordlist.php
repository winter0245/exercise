<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><meta name="renderer" content="webkit">

    <title>运动记录列表</title>
 
    <link href="./../css/bootstrap.min.css?v=3.4.0" rel="stylesheet">
    <link href="./../font-awesome/css/font-awesome.css?v=4.3.0" rel="stylesheet">

    <link href="./../css/plugins/jQueryUI/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">

    <!-- Data Tables -->
    <link href="./../css/plugins/jqgrid/ui.jqgrid.css" rel="stylesheet">

    <link href="./../css/animate.css" rel="stylesheet">
    <link href="./../css/style.css" rel="stylesheet">
<style type="text/css">
      .tr1 { background-color: #DDDDDC; background-image: none; }

    </style>
    </head>
    <body style="background:#fff;">
      <div class="jqGrid_wrapper">
          <table id="table_list_1" style=""></table>
                                    <div id="pager_list_1"></div>
                                </div>
    </body>
    
     <!-- Mainly scripts -->
    <script src="./../js/jquery-2.1.1.min.js"></script>
    <script src="./../js/bootstrap.min.js?v=3.4.0"></script>
    <script src="./../js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="./../js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Peity -->
    <script src="./../js/plugins/peity/jquery.peity.min.js"></script>

    <!-- jqGrid -->
    <script src="./../js/plugins/jqgrid/i18n/grid.locale-cn.js"></script>
    <script src="./../js/plugins/jqgrid/jquery.jqGrid.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="./../js/hplus.js?v=2.2.0"></script>
    <script src="./../js/plugins/pace/pace.min.js"></script>

    <script src="./../js/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function () {
     // Configuration for jqGrid Example 1
            $("#table_list_1").jqGrid({
                
                datatype: "local",
                height: 450,
                autowidth: true,
                shrinkToFit: true,
                altRows:true, 
                altclass:'tr1',
                rowNum: 14,
                rowList: [10, 20, 30],
                colNames: ['序号', '日期', '数量', '单位','类型', '耗时(分钟)', '备注'],
                colModel: [
                    {
                        name: 'id',
                        index: 'id',
                        width: 60,
                        sorttype: "int"
                    },
                    {
                        name: 'date',
                        index: 'date',
                        width: 90,
                        sorttype: "date",
                        formatter: "date"
                    },
                    {
                        name: 'count',
                        index: 'count',
                        width: 100,
                        sorttype: "float"
                    },
                    {
                        name: 'unit',
                        index: 'unit',
                        width: 80,
                        align: "right",               
                    },
                    {
                        name: 'type',
                        index: 'type',
                        width: 80,
                        align: "right",
                 
                    },
                    {
                        name: 'totaltime',
                        index: 'totaltime',
                        width: 80,
                        align: "right",
                        sorttype: "float"
                    },
                    {
                        name: 'comment',
                        index: 'comment',
                        width: 150,
                        sortable: false
                    }
                ],
                pager: "#pager_list_1",
                viewrecords: true,
                caption: "运动记录列表",
                hidegrid: false
            });
  
  fetchGridData();
  function fetchGridData() {
                
             
				// show loading message
				$("#table_list_1")[0].grid.beginReq();
                $.ajax({
                    url: "exercisedata.php",
                    success: function (result) {
                   var data=eval(result);
						// set the new data
						$("#table_list_1").jqGrid('setGridParam', { data: data});
						// hide the show message
						$("#table_list_1")[0].grid.endReq();
						// refresh the grid
						$("#table_list_1").trigger('reloadGrid');
                    }
                });
            }
  

          

            // Add responsive to jqGrid
            $(window).bind('resize', function () {
                var width = $('.jqGrid_wrapper').width();
                $('#table_list_1').setGridWidth(width);
              
            });
            
            
            
            
            
        });
    </script>
</html>
