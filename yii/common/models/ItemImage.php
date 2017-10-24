<?php
/**
 * ItemImage.php
 *
 * Copyright (c) 2017 南京码动通信科技有限公司 All rights reserved.{@see http://www.digirun.cn}
 *
 * @copyright Copyright (c) 2017 Digirun.cn All rights reserved.
 * @author Niu Jie<1033751979@qq.com>
 * @since 2017/5/7 18:47 created
 */
namespace common\models;

class ItemImage extends \yii\db\ActiveRecord{

    public static function className() {

        return get_class(new static());
    }

}