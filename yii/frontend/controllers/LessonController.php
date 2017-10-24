<?php
/**
 * LessonController.php
 *
 * Copyright (c) 2017 南京码动通信科技有限公司 All rights reserved.{@see http://www.digirun.cn}
 *
 * @copyright Copyright (c) 2017 Digirun.cn All rights reserved.
 * @author Niu Jie<1033751979@qq.com>
 * @since 2017/4/25 21:43 created
 */


namespace frontend\controllers;


class LessonController
{
    /**
     * @var string 时间
     */
    private $duration;

    /**
     * @var costStrategyController $costStrategy
     */
    private $costStrategy;

    public function __construct($duration, costStrategyController $strategy)
    {
        $this->duration = $duration;
        $this->costStrategy = $strategy;
    }

    public function actionCost()
    {
        return $this->costStrategy->actionCost($this);
    }

    public function actionChargeType()
    {
        return $this->costStrategy->actionChargeType();
    }

    public function actionGetDuration()
    {
        return $this->duration;
    }

}