<?php
/**
 * CssJsAsset.php
 *
 * Copyright (c) 2017 南京码动通信科技有限公司 All rights reserved.{@see http://www.digirun.cn}
 *
 * @copyright Copyright (c) 2017 Digirun.cn All rights reserved.
 * @author Niu Jie<1033751979@qq.com>
 * @since 2017/10/21 13:12 created
 */
namespace backend\assets;

use yii\web\AssetBundle;

class CssJsAsset extends AssetBundle{

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
      'css/web.css',
    ];




}