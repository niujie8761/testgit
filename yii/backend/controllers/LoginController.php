<?php
/**
 * LoginController.php
 *
 * Copyright (c) 2017 南京码动通信科技有限公司 All rights reserved.{@see http://www.digirun.cn}
 *
 * @copyright Copyright (c) 2017 Digirun.cn All rights reserved.
 * @author Niu Jie<1033751979@qq.com>
 * @since 2017/7/8 12:12 created
 */


namespace backend\controllers;

use yii;
use yii\web\Controller;
use backend\models\LoginModel;
use yii\web\Response;
use yii\captcha\CaptchaAction;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use backend\models\city;
use common\helps\tools;

class LoginController  extends  Controller
{
    public $enableCsrfValidation = false;
    public $layout = false;
    public function actions()
    {
        return [
            'check' => 'backend\controllers\center\checkAction',
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'height'=>40,
                'width' => 130,
                'offset' => 5,
                'maxLength' => 6,
                'minLength' => 6,
            ]
        ];
    }

    public function actionHeader()
    {
        $sql = "select * from keeper_city";
        $cityList = city::findBysql($sql)->asArray()->all();
        //$loginUser = $this->loginUser;
        //$userCity = $loginUser['kam_role']['city'];
        $userCityName = array();
        foreach($cityList as $key => $value) {
           // if(in_array($value['city'], $userCity)) {
                $userCityName[] = tools::array_iconv($value['city_name'], 'gb2312', 'utf-8');
            //}
        }
        echo "<pre>";
        print_r($userCityName);exit;
        $loginUser['kam_nickname'] = tools::array_iconv($loginUser['kam_nickname'], 'gb2312', 'utf-8');
        $data['city'] = $userCityName;
        return $this->render('header', [
            'data' => $data,
            'loginUser' => $loginUser
        ]);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionMain()
    {
        return $this->render('main');
    }

    public function actionMenus()
    {
        return $this->render('menus');
    }
}