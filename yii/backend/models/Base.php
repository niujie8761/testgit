<?php
/**
 * Base.php
 *
 * Copyright (c) 2017 南京码动通信科技有限公司 All rights reserved.{@see http://www.digirun.cn}
 *
 * @copyright Copyright (c) 2017 Digirun.cn All rights reserved.
 * @author Niu Jie<1033751979@qq.com>
 * @since 2017/7/8 16:34 created
 */


namespace backend\models;

use yii;

class Base extends \yii\db\ActiveRecord
{
    /**
     * @var
     */
    private static $instance = array();
    /**
     * @var
     */
    protected $name;


    public static function getInstance($name)
    {
        Yii::$app->name = $name;
        if(isset(self::$instance[$name])) {
            return self::$instance[$name];
        }else {
            $objModel = ucwords($name);
            if (class_exists($objModel)) {
                self::$instance[$name] = new $objModel();
            } else {
                self::$instance[$name] = new self();
            }
            return self::$instance[$name];
        }
    }

    public function getOne($key, $value)
    {
        $sql = "select * from keeper_".Yii::$app->name." where ".$key." = ".$value;
        $rows = Yii::$app->db->createCommand($sql)->queryOne();
        return $rows;
    }

    public function getAll($key = "", $value ="")
    {
        if(!empty($key) && !empty($value)) {
            $sql = "select * from keeper_".Yii::$app->name." where ".$key." = ".$value;
        }else {
            $sql = "select * from keeper_".Yii::$app->name;
        }
        $rows = Yii::$app->db->createCommand($sql)->queryAll();
        return $rows;
    }

}