<?php
/**
 * Menu.php
 *
 * Copyright (c) 2017 南京码动通信科技有限公司 All rights reserved.{@see http://www.digirun.cn}
 *
 * @copyright Copyright (c) 2017 Digirun.cn All rights reserved.
 * @author Niu Jie<1033751979@qq.com>
 * @since 2017/10/21 18:03 created
 */
namespace backend\models;

use yii;

class Menu extends yii\db\ActiveRecord {

    public static function tableName()
    {
        return "keeper_menu";
    }

    public static function addData($data)
    {
        $model = new self();
        $model->kamu_parent_id = $data['kamu_parent_id'];
        $model->kamu_name = $data['kamu_name'];
        $model->kamu_url = $data['kamu_url'];
        $model->kamu_as_menu = $data['kamu_as_menu'];
        return $model->insert();
    }
}