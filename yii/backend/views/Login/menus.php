<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gbk" />
    <link href="/backend/web/css/base.css" type="text/css" rel="stylesheet">
    <script src="/backend/web/js/jquery-1.8.3.min.js"></script>
</head>
<body style="background:#8ECDF2;">
<style type="text/css" >
    .on {
        color:#DB4701 !important;
        font-weight:bold !important;
    }
</style>
<script type="text/javascript">
    $(document).ready(function(){
        $(".menu-lev-2 a").each(function(){
            $(this).bind("click",function(){
                $(".menu-lev-2 a").removeClass("on");
                $(this).addClass("on");
            });
        });

    });
</script>
<div class="mymenus">
    <?php foreach ($menus as $key => $value) : ?>
            <div class="menu-lev-<?=$value['level_depth']?>">
                <?php if($value['kamu_parent_id']!=0) : ?>
                    <a href="<?=$value['kamu_url']?>" target="mainpage"><?=$value['kamu_name']?></a>
                <?php else : ?>
                    <?=$value['kamu_name']?>
                <?php endif; ?>
            </div>
    <?php endforeach; ?>
</div>
</body>
</html>
