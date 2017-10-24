<?php
/**
 * MenuController.php
 *
 * Copyright (c) 2017 南京码动通信科技有限公司 All rights reserved.{@see http://www.digirun.cn}
 *
 * @copyright Copyright (c) 2017 Digirun.cn All rights reserved.
 * @author Niu Jie<1033751979@qq.com>
 * @since 2017/10/18 21:31 created
 */

namespace backend\controllers;

use yii;
use backend\controllers\BaseController;
use common\helps\tools;
use backend\models\Menu;

class MenuController extends BaseController{

    public $layout = false;
    public $enableCsrfValidation = false;

    public function actionAdmin()
    {
        $menusStr = Yii::$app->redis->get('menus');
        $menusArr = unserialize($menusStr);
        $menus = tools::tree_categories($menusArr, 0, 1, 0, 'kamu_parent_id', 'kamu_id');
        $top_menus = array();
        foreach($menus as $key => $value) {
            if($value['kamu_parent_id'] == 0) {
                $top_menus[] = $value;
            }
        }
        return $this->render('admin', [
                'menus' => $menus,
                'top_menus' => $top_menus,
                ]
        );
    }

    public function actionSave()
    {
        $data = Yii::$app->request->post();
        $data = tools::array_iconv($data, 'utf-8', 'gbk');
        $result = menu::addData($data);
        if($result) {
            $sql = "select * from keeper_menu where isdel=0 order by position desc";
            $menu = Menu::findBySql($sql)->asArray()->all();
            $menu = tools::array_iconv($menu, 'gbk', 'utf-8');
            Yii::$app->redis->set('menus', serialize($menu));
            $this->redirect(['/menu/admin']);
        }

    }










}