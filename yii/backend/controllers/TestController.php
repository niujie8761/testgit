<?php
/**
 * TestController.php
 *
 * Copyright (c) 2017 南京码动通信科技有限公司 All rights reserved.{@see http://www.digirun.cn}
 *
 * @copyright Copyright (c) 2017 Digirun.cn All rights reserved.
 * @author Niu Jie<1033751979@qq.com>
 * @since 2017/10/30 20:16 created
 */

namespace backend\controllers;

use  backend\controllers\BaseController;

class TestController extends BaseController{

    public function actionIndex()
    {
        echo 123;
        exit;
    }



}