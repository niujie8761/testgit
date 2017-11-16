<link type="text/css" rel="stylesheet" href="/backend/web/css/365baseAdmin.css">
<link type="text/css" rel="stylesheet" href="http://pic.house365.com/erbu/fgjadmin/css/365baseAdmin.css">
<link rel="stylesheet" href="/backend/web/css/boxy.css" type="text/css" />
<script src="http://pic.house365.com/static/jquery/jquery-1.11.1.min.js"></script>
<div class="pageTitle">
    <div class="title">后台菜单权限管理</div>
</div>
<ul class="optionList">
    <li><a href="javascript:void(0);" class="auth"><span class="icon-add"></span>添加权限菜单</a></li>
</ul>
<table width="100%" class="tableList">
    <tr>
        <th width="40">ID</th>
        <th width="300">名称</th>
        <th width="300">地址</th>
        <th width="80">作为菜单</th>
        <th width="80">排序</th>
        <th>操作</th>
    </tr>
    <?php foreach ($menus as $key => $_menu) : ?>
        <tr <?php if($key%2 == 0) {echo "class='odd'";}else{echo "class='even'";}?>>
            <td><?=$_menu['kamu_id']?></td>
            <td style="padding-left:<?=($_menu['level_depth']-1)*25?>px;"><?=$_menu['kamu_name']?></td>
            <td><?=$_menu['kamu_url']?></td>
            <td><?=$_menu['kamu_as_menu']==1?'<font color="Green">是</font>':'<font color="Red">否</font>'?></td>
            <td><?=$_menu['position']?></td>
            <td><a class="edit" href="javascript:void(0);">编辑</a> | <a class="delete" href="/menu/admin_delete?id=<?=$_menu['kamu_id']?>">删除</a></td>
        </tr>
    <?php endforeach; ?>
</table>
<style>
    #J_add_menu{position:absolute;top:0;left:0;width:600px;height:300px;background:#FFFFFF;z-index:2;border:2px solid #318631;}
    #J_add_menu .close{color: red;cursor: pointer;display: block;float: right;font-size: 12px;margin: 5px;}
</style>
<div id="J_add_menu" style="display:none;">
    <span class="close">关闭</span>
    <br>
    <form method="post" action="<?php echo Yii::$app->urlManager->createUrl(['menu/add'])?>" >
        <table class="tableForm" width="100%">
            <tr>
                <th style="width:25%;">菜单名称：</th>
                <td>
                    <input class="text" name="kamu_name" id="menu_name" value="">
                </td>
            </tr>
            <tr>
                <th style="width:25%;">菜单地址：</th>
                <td>
                    <input class="textBig" name="kamu_url" id="menu_url" value="">
                </td>
            </tr>
            <tr>
                <th style="width:25%;">排序：</th>
                <td>
                    <input class="textSmall" name="position" id="menu_position" value="">数值大的在前面
                </td>
            </tr>
            <tr>
                <th style="width:25%;">父集菜单：</th>
                <td>
                    <select class="select" name="kamu_parent_id" id="menu_parent">
                        <option value="0">作为父菜单使用</option>
                        <?php foreach ($top_menus as $_menu) : ?>
                            <option value="<?=$_menu['kamu_id']?>"><?=$_menu['kamu_name']?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th style="width:25%;">是否作为菜单：</th>
                <td>
                    <select class="select" name="kamu_as_menu" id="menu_as">
                        <option value="1">是</option>
                        <option value="0">否</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <input type="hidden" value="0" name="kamu_id" id="kamu_id"/>
                    <input type="submit" class="submit" value="提交">
                </td>
            </tr>
        </table>
    </form>
</div>
<script>
    $(document).ready(function(){

        //添加权限菜单
       $('.auth').on('click', function() {
           var height = $(window).height();
           var width = $(window).width();
           var top = (height-300)/2+'px';
           var left = (width-600)/2+'px';
           $("#J_add_menu").css({top: top, left: left});
           $("#J_add_menu").show();

       });
        //编辑权限菜单
        $('.edit').on('click', function() {
            var height = $(window).height();
            var width = $(window).width();
            var top = (height-300)/2+'px';
            var left = (width-600)/2+'px';
           var kamu_id = $(this).parents('tr').children('td').eq(0).html();
           $.ajax({
               'url': '<?= Yii::$app->urlManager->createUrl('menu/save')?>',
               'type' : 'post',
               'dataType' : 'json',
               'async' : 'false',
               'data' : {kamu_id: kamu_id},
               'success' : function(result) {
                        $("#menu_name").val(result.kamu_name);
                        $("#menu_url").val(result.kamu_url);
                        $("#menu_position").val(result.position);
                        $("#menu_parent option").each(function() {
                           if($(this).val() == result.kamu_parent_id) {
                               $(this).prop("selected", true);
                           }
                        });
                        $("#menu_as option").each(function() {
                           if($(this).val() == result.kamu_as_menu) {
                               $(this).prop("selected", true);
                           }
                        });
                        $("#kamu_id").val(result.kamu_id);
                        $("#J_add_menu").css({top: top, left: left});
                        $("#J_add_menu").show();
               }
           });

        });

    });
    var menus = new Array();
    <?php foreach ($menus as $key => $val):?>
    menus['<?=$key?>'] = new Array();
    <?php foreach ($val as $key2 => $val2):?>
    <?php $val2 = str_replace(array('"',"\r\n","\n"),array('\"','\n','\n'),$val2) ?>
    menus['<?=$key?>']['<?=$key2?>'] = "<?=$val2?>";
    <?php endforeach;?>
    <?php endforeach;?>

    //表单数据JS填充
   /* function fill_menu_form(key){
        //变量赋值
        var menu_name = '';
        var menu_url = '';
        var menu_parent = 0;
        var menu_as = 1;
        var menu_id = 0;
        var menu_position = 10000;
        if( key!=-1 ){
            menu_name = menus[key]['kamu_name'];
            menu_url = menus[key]['kamu_url'];
            menu_parent = menus[key]['kamu_parent_id'];
            menu_as = menus[key]['kamu_as_menu'];
            menu_id = menus[key]['kamu_id'];
            menu_position = menus[key]['position'];
        }
        $('#menu_name').val(menu_name);
        $('#menu_url').val(menu_url);
        $('#menu_parent').val(menu_parent);
        $('#menu_as').val(menu_as);
        $('#menu_id').val(menu_id);
        $('#menu_position').val(menu_position);

        //模块展示
        var win_w = $(window).width();
        var win_h = $(window).height();
        var top = (win_h-300)/2;
        var left = (win_w-600)/2;
        $('#J_add_menu').css({top:top+'px',left:left+'px'});
        $('#J_add_menu').show();
        return false;
    }*/
    $(function(){
        $('#J_add_menu .close').click(function(){
            $('#J_add_menu').hide();
        });
    });
</script>