<?php
/**
 * UploaderController.php
 *
 * Copyright (c) 2017 南京码动通信科技有限公司 All rights reserved.{@see http://www.digirun.cn}
 *
 * @copyright Copyright (c) 2017 Digirun.cn All rights reserved.
 * @author Niu Jie<1033751979@qq.com>
 * @since 2017/5/4 22:13 created
 */


namespace frontend\controllers;

use common\models\Item;
use common\models\ShoppingCart;
use Yii;
use yii\web\Controller;

use yii\web\UploadedFile;

class UploaderController extends Controller
{

    public function actionPaging()
    {
        return $this->render('paging');
    }
    public function actionDisplay()
    {
       return $this->render('display');
    }

    public function actionUpload()
    {
        $uploadSuccessPath = "";
        $fileName = "file";
        if(isset($_FILES[$fileName])) {
           $file = UploadedFile::getInstanceByName($fileName);
           //上传文件存放的位置
           $dir = '../../public/uploads/'.date("Ymd");
           if(!is_dir($dir)) {
               mkdir($dir);
           }
           if($file->saveAs($dir."/".$file->name)) {
                $uploadSuccessPath = "/uploads/" . date("Ymd") . "/" .$file->name;
           }
        }
        return $this->render('upload',
            [
                'uploadSuccessPath' => $uploadSuccessPath
            ]);
    }

    public function actionRelate()
    {
        /**
         * @var ShoppingCart $shoppingCartM
         */
        $shoppingCartM = \common\models\ShoppingCart::getInstance();
        $result = $shoppingCartM->test();
        print_r($result);
    }

    public function actionHasOne()
    {
        /*$shoppingCarts = ShoppingCart::find()->limit(2)->with('item')->all();
        foreach($shoppingCarts as $shoppingCart) {
            $item = $shoppingCart->item;
            echo "<hr/>";
            echo $item->name;
        }*/
        $itemM = Item::findOne(81);
        $data = $itemM->getItemImage()->where('is_default = 1')->all();
        echo "<pre>";
        print_r($data);
    }
}