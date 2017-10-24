<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gbk" />
    <link href="/backend/web/css/base.css" type="text/css" rel="stylesheet">
    <script src="/backend/web/js/jquery-1.8.3.min.js"></script>
</head>
<!--<body style="background:#318631;">-->
<body style="background:#095C8C;">
<div style="height:40px;">
    <div style="float:left;line-height:40px;font-size:16px;color:#FFFFFF;font-weight:bold;margin-left:10px;">365房管家 管理后台</div>
    <div style="float:left;line-height:40px;color:#EEEEEE;margin-left:40px;">切换城市：
        <select id="select_city">
            <?php
            foreach ($data['city'] as $k=>$v) : ?>
                <option value="<?=$k?>"><?=$v?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div style="float:right;line-height:40px;color:#DAEAF0;margin-right:10px;">
        <a href="/main" target="mainpage" style="color:#FFFFFF;">回到首页</a> &nbsp;
        欢迎，<?=$loginUser['kam_nickname']?> <a style="color:Red;" href="javascript:window.parent.location.href='/logout';">[退出]</a>
    </div>
</div>
<script>
    $(function(){
        $('#select_city').change(function(){
            window.parent.location.href = '/change_city?city='+$(this).val();
        });
    });
</script>
</body>
</html>
