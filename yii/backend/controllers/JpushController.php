<?php
/**
 * JpushController.php
 *
 * Copyright (c) 2017 南京码动通信科技有限公司 All rights reserved.{@see http://www.digirun.cn}
 *
 * @copyright Copyright (c) 2017 Digirun.cn All rights reserved.
 * @author Niu Jie<1033751979@qq.com>
 * @since 2017/10/29 19:51 created
 */
namespace backend\controllers;

use yii;
use backend\controllers\BaseController;


class JpushController extends BaseController{


    protected $app_key = "dd1066407b044738b6479275";
    protected $master_secret = "e8cc9a76d5b7a580859bcfa7";
    protected $client;

    public function init()
    {
        $this->client = new \JPush\Client($this->app_key, $this->master_secret);
    }
    public function actionSend()
    {
        $content = "开发商确认可以安排带看";
        //消息的内容
       // $content = iconv('GBK', 'UTF-8',$content);

        //消息的默认标题
       // $title = iconv('GBK', 'UTF-8','房管家经纪人');

        $extra = array('type' => 2);

        $pusher = $this->client->push();
        $pusher->setPlatform('all');
        $pusher->addAllAudience();
        $pusher->setNotificationAlert('Hello, JPush');
        try {
            $pusher->send();
        } catch (\JPush\Exceptions\JPushException $e) {
            // try something else here
            print $e;
        }
    }









}