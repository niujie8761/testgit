<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>365房管家后台管理系统</title>
    <link href="/backend/web/css/login.css" rel="stylesheet" type="text/css" />
    <script src="/backend/web/js/jquery-1.8.3.min.js"></script>
</head>
<form id="my-form" method="post" action="site/check">
    <div class="Main">
        <ul>
            <li class="top"></li>
            <li class="top2"></li>
            <li class="topA"></li>
            <li class="topB"><span>
                <img src="/backend/web/images/login/logo.png" alt="" style="margin-top: 40px;margin-left: 13px;" />
            </span></li>
            <li class="topC"></li>
            <li class="topD">
                <ul >
                    <li>
                        <span class="left">用户名：</span>
                        <input id="username" type="text" name="username" class="txt" />
                    </li>
                    <li>
                        <span class="left">密码：</span>
                        <input id="password" type="password" name="password" class="txt" />
                    </li>
                    <li>
                        <span class="left">验证码：</span>
                        <input id="verifyCode" type="password" name="verifyCode" class="txt" />
                        <?= Captcha::widget(['name'=>'captchaimg','captchaAction'=>'/login/captcha','imageOptions'=>['id'=>'captcha_img','class'=>'code', 'title'=>'换一个', 'alt'=>'换一个', 'style'=>'cursor:pointer; margin-left:55px;'],'template'=>'{image}']);?>
                    </li>
                </ul>
            </li>
            <li class="topE"></li>
            <li class="middle_A"></li>
            <li class="middle_B"></li>
            <li class="middle_C">
            <span class="btn" id="login_submit">
               <img style = "margin-top:20px;" src="/backend/web/images/login/btnlogin.gif" />
            </span>
            </li>
            <li class="middle_D"></li>
            <li class="bottom_A"></li>
        </ul>
    </div>
</form>

<script>
    $(function(){
        changeVerifyCode();
        $("#captcha_img").click(function() {
            changeVerifyCode();
        });
        function changeVerifyCode() {
            $.ajax({
                url : '/backend/web/login/captcha?refresh',
                dataType : 'json',
                success : function(result) {
                        $("#captcha_img").attr('src', result.url);
                }
            })
        }

        $('#login_submit').click(function(){
            $.ajax({
                url : "/backend/web/login/check",
                type : "post",
                dataType : "json",
                data : $("#my-form").serialize(),
                success : function(result) {
                    if(result.code == '400') {
                        alert(result.msg);
                    }else if(result.code == '100') {
                        window.location.href='/backend/web/index/index';
                    }
                }
            });
        });
    });
</script>
</body>
</html>
