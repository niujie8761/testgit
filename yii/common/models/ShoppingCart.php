<?php
/**
 * ShoppingCart.php
 *
 * Copyright (c) 2017 南京码动通信科技有限公司 All rights reserved.{@see http://www.digirun.cn}
 *
 * @copyright Copyright (c) 2017 Digirun.cn All rights reserved.
 * @author Niu Jie<1033751979@qq.com>
 * @since 2017/5/7 10:45 created
 */
namespace common\models;


use yii\web\NotFoundHttpException;

class ShoppingCart  extends  \yii\db\ActiveRecord {


    private static $instance;

    

    /**
     * @return ShoppingCart
     */
    public static function getInstance() {
        if(self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }


    public function test()
    {
        //修改一条数据
        $model = ShoppingCart::findOne(827);
        if($model ==null) {
            throw new NotFoundHttpException();
        }else {
            $model->num = 200;
            $model->save();
        }
        die();
        $shoppingCartM = new ShoppingCart();
        //新建一条记录
        $shoppingCartM->account_id = 10;
        $shoppingCartM->item_id = 100;
        $shoppingCartM->item_spec_ids = 0;
        $shoppingCartM->activity_id = 0;
        $shoppingCartM->num = 30;
        $shoppingCartM->pubdate = time();
        if($shoppingCartM->validate() && $shoppingCartM->save()) {
            return ['shopping_cart_id' => $shoppingCartM->shopping_cart_id];
        }else {
            echo 2;
        }

        $shoppingCart = ShoppingCart::find()->where(['shopping_cart_id' => 719])->one();
        echo "<pre>";
        print_r($shoppingCart);
        //$shoppingCart->save();
    }

    public  function getItem() {

        return $this->hasOne(Item::className(),['item_id' => 'item_id']);
    }











}