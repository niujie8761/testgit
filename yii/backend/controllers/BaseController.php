<?php
/**
 * BaseController.php
 *
 * Copyright (c) 2017 南京码动通信科技有限公司 All rights reserved.{@see http://www.digirun.cn}
 *
 * @copyright Copyright (c) 2017 Digirun.cn All rights reserved.
 * @author Niu Jie<1033751979@qq.com>
 * @since 2017/7/8 11:57 created
 */


namespace backend\controllers;

use backend\models\Manger;
use yii;
use yii\web\Controller;
use yii\web\Session;
use backend\models\Base;

class BaseController    extends Controller
{
    /**
     * @var
     */
    protected $loginUser;

    public function init()
    {
        $cookie = Yii::$app->request->cookies;
        $cookieData = $cookie->getValue('cookieName');
        $id = base64_decode($cookieData['kam_id']);
        $username = base64_decode($cookieData['kam_username']);
        $password = base64_decode($cookieData['kam_password']);
        $str = base64_decode($cookieData['str']);
        $strAuth = base64_decode($cookieData['strAuth']);
        $complexStr = $id.'-'.$username.'-'.$password;
        $complexAuth = $password.'-'.$username.'-'.$id;
        if($str == $complexStr && $strAuth == $complexAuth && $this->loginUser == "") {
            $mangerM = Base::getInstance('manger');
            $rows = $mangerM->getOne('kam_id', $id);
            $rows['kam_role'] = unserialize($rows['kam_role']);
            //菜单权限
            $roleM = Base::getInstance('role');
            $rowsA = $roleM->getOne('id', $rows['role_id']);
            $rows['rights'] = unserialize($rowsA['rights']);
            //经纪人对应的楼盘
            $projectmanagerM = Base::getInstance('projectmanager');
            $rowsB = $projectmanagerM->getAll('kam_id', $id);
            $lpIds = array();
            foreach($rowsB as $value) {
                $lpIds[] = $value['lp_id'];
            }
            $rows['lp_ids'] = $lpIds;
            $this->loginUser = $rows;
            $session = Yii::$app->session;
            $session->set('managerInfo', $rows);
        }else if(!empty($this->loginUser)) {

        }else {
            return $this->redirect('/backend/web/site/login');
        }
    }
}