<?php
/**
 * TimedCostStrategyController.php
 *
 * Copyright (c) 2017 南京码动通信科技有限公司 All rights reserved.{@see http://www.digirun.cn}
 *
 * @copyright Copyright (c) 2017 Digirun.cn All rights reserved.
 * @author Niu Jie<1033751979@qq.com>
 * @since 2017/4/25 22:07 created
 */


namespace frontend\controllers;


class TimedCostStrategyController   extends CostStrategyController
{
    public function actionCost(LessonController $lesson)
    {
        return 30;
        // TODO: Implement actionCost() method.
    }

    public function actionChargeType()
    {
        return "fixed rate";
        // TODO: Implement actionChargeType() method.
    }

}