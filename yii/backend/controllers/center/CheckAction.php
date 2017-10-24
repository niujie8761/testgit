<?php

/**
 * CheckAction.php
 *
 * Copyright (c) 2017 南京码动通信科技有限公司 All rights reserved.{@see http://www.digirun.cn}
 *
 * @copyright Copyright (c) 2017 Digirun.cn All rights reserved.
 * @author Niu Jie<1033751979@qq.com>
 * @since 2017/7/27 21:17 created
 */

namespace backend\controllers\center;

use common\models\LoginForm;
use yii;
use yii\base\Action;
use backend\models\Manger;

class CheckAction extends Action
{
    public function run()
    {
        $request = Yii::$app->request;
        $controller = $this->controller;
        /** @var \yii\captcha\CaptchaAction $captcha */
        $captcha = $controller->createAction('captcha');
        if($request->isPost) {
            $data = $request->post();
            $username = $data['username'];
            $password = $data['password'];
            $verifyCode = $data['verifyCode'];
            Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
            if($username == '') {
                return [
                    'code' => 400,
                    'msg' => '用户名不能为空',
                    'data' => [],
                ];
            }
            if($password == '') {
                return [
                    'code' => 400,
                    'msg' => '密码不能为空',
                    'data' => [],
                ];
            }
            $captchaOk = $captcha->validate($verifyCode, false);
            if(!$captchaOk) {
                return [
                    'code' => 400,
                    'msg' => '验证码出错',
                    'data' => [],
                ];
            }
            $sql = "select kam_id, role_id, kam_role, kam_username, kam_password from keeper_manger where kam_username ='".$username."' and kam_password ='".md5($password)."'";
            $rows = Manger::findBysql($sql)->asArray()->one();
            if(empty($rows)) {
                return [
                    'code' => 400,
                    'msg' => '账号或者密码不正确!',
                    'data' => '',
                ];
            }
            //设置校验
            $str = $rows['kam_id'].'-'.$rows['kam_username'].'-'.$rows['kam_password'];
            $strAuth = $rows['kam_password'].'-'.$rows['kam_username'].'-'.$rows['kam_id'];
            $cookieData = [
                'kam_id' => base64_encode($rows['kam_id']),
                'kam_username' => base64_encode($rows['kam_username']),
                'kam_password' => base64_encode($rows['kam_password']),
                'str' => base64_encode($str),
                'strAuth' => base64_encode($strAuth)
            ];
            $cookie = new \yii\web\Cookie();
            $cookie->name = 'cookieName';
            $cookie->expire = time()+3600;
            $cookie->value = $cookieData;
            Yii::$app->response->getCookies()->add($cookie);
            return [
                'code' => 100,
                'msg' => '登录成功',
                'data' => $rows,
            ];
        }
    }
}