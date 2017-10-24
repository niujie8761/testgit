<?php
/**
 * UploadForm.php
 *
 * Copyright (c) 2017 南京码动通信科技有限公司 All rights reserved.{@see http://www.digirun.cn}
 *
 * @copyright Copyright (c) 2017 Digirun.cn All rights reserved.
 * @author Niu Jie<1033751979@qq.com>
 * @since 2017/5/6 11:05 created
 */
namespace app\models;


use yii\base\Model;
use yii\web\UploadedFile;


/**
 * Class UploadForm
 * @package app\models
 */
class UploadForm  extends Model
{
    /**
     * @var UploadedFile file attribute
     */
    public $file;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['file'], 'file', 'extensions' => 'jpg, png'],
        ];
    }

}