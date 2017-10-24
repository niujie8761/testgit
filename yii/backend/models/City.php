<?php
/**
 * City.php
 *
 * Copyright (c) 2017 南京码动通信科技有限公司 All rights reserved.{@see http://www.digirun.cn}
 *
 * @copyright Copyright (c) 2017 Digirun.cn All rights reserved.
 * @author Niu Jie<1033751979@qq.com>
 * @since 2017/7/8 19:38 created
 */


namespace backend\models;


class City extends  \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'keeper_city';
    }
}