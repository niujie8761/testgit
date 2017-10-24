<?php
/**
 * CostStrategyController.php
 *
 * Copyright (c) 2017 南京码动通信科技有限公司 All rights reserved.{@see http://www.digirun.cn}
 *
 * @copyright Copyright (c) 2017 Digirun.cn All rights reserved.
 * @author Niu Jie<1033751979@qq.com>
 * @since 2017/4/25 22:02 created
 */


namespace frontend\controllers;


abstract class CostStrategyController
{
    abstract public function actionCost(LessonController $lesson);

    abstract public function actionChargeType();
}