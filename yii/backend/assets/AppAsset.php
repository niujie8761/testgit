<?php

namespace backend\assets;

use yii;
use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/base.css',
    ];
    public $js = [
    ];
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];

    public function init()
    {
        $action_id = Yii::$app->controller->action->id;
        if($action_id == 'index') {
            $this->depends[] = 'backend\assets\CssJsAsset';
        }
    }
}
