<?php
/**
 * Login.php
 *
 * Copyright (c) 2017 南京码动通信科技有限公司 All rights reserved.{@see http://www.digirun.cn}
 *
 * @copyright Copyright (c) 2017 Digirun.cn All rights reserved.
 * @author Niu Jie<1033751979@qq.com>
 * @since 2017/7/22 16:54 created
 */
namespace backend\models;

use Yii;

class Login extends Base{

    public $verifyCode;
    public $username;
    public $password;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['verifyCode', 'captcha'],
            [['username', 'password'], 'required', 'message' => '{attribute}不能为空!'],
        ];
    }

  /*  public function codeVerify($attribute)
    {
        $captcha_validate = new \yii\captcha\CaptchaAction('captcha', Yii::$app->controller);
        if($this->$attribute) {
            $code = $captcha_validate->getVerifyCode(true);
            echo $code;
            if($this->$attribute != $code) {
                $this->addError($attribute, 'The verification code is incorrect');
            }
        }
    }*/
    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'username' => '用户名:',
            'password' => '密码:',
            'verifyCode' => '验证码:',
        ];
    }
}