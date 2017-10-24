<?php

use yii\helpers\Html;

?>

<style type="text/css">
    *{ margin:0px auto; padding:0px; font-family:"微软雅黑"}
    .b3{ list-style:none; width:400px; height:30px; font-size:16px; text-align:center; line-height:30px; vertical-align:middle; position:relative}
    .b4{ width:50px; height:30px; float:left; font-size:20px; text-align:center; line-height:30px; vertical-align:middle}
    .b4:hover{ cursor:pointer; background-color:#FC6}
    #fy_shang{ font-size:16px; text-align:center; line-height:30px; vertical-align:middle; width:60px; float:left}
    #fy_xia{ font-size:16px; text-align:center; line-height:30px; vertical-align:middle; width:60px}
    #fy_shang:hover{ cursor:pointer; background-color:#FC6}
    #fy_xia:hover{ cursor:pointer; background-color:#FC6}
</style>




<!--分页开始-->
    <ul class="pagination b3" id="fy_list">
    </ul>
    <input type="hidden" value="1" id="fy_n" />

<!--分页结束-->

<script type="text/javascript">
    $(document).ready(function(){
        JiaZai();
        var zys = 0;
    });
    function JiaZai(){
       var n = $("#fy_n").val();
        $.ajax({
            url : "",
            data : {n:n ,gjz: ""},
            type : "post",
            dataType : "json",
            success : function(data) {
                var s = "";
                for(var i in data) {
                    s+="<tr>" +
                        "<td><input type='checkbox' class='qx'  value='"+data[i].id+"' name='sc[]' /></td>" +
                        "<td class='hidden-xs'>"+data[i].id+"</td><td>"+data[i].name+"</td>" +
                        "<td class='hidden-xs'>"+data[i].details+"</td>" +
                        "<td class='hidden-xs'>"+data[i].wprice+"</td>" +
                        "<td class='hidden-xs'>"+data[i].dprice+"</td>" +
                        "<td class='hidden-xs'>"+data[i].class+"</td>" +
                        "<td><a href='xiugai.php?c="+data[i].id+"'>修改</a></td>" +
                        "<td><a href='shanchuchuli.php?c="+data[i].id+"' onclick=\"return confirm('确定删除吗？')\">删除</a></td>" +
                        "</tr>";//拼接表格显示内容
                }
                $("#")
            }


        })
    }

</script>