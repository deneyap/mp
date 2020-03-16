<?php

namespace backend\forms;

use Yii;
use yii\base\Model;
use backend\models\Admin;
use backend\models\AdminLogin;

class LoginForm extends Model {

    public $email;
    public $password;
    public $rememberMe = true;
    private $_admin;

    public function rules() {
        return [
            [
                ['email', 'password'], 'required'
            ],
            ['email','email'],
            ['rememberMe', 'boolean'], 
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels() {
        return [
            'email' => 'E-posta',
            'password' => 'Şifre'
        ];
    }

    public function validatePassword($attribute, $params) {
        if (!$this->hasErrors()) {
            $admin = $this->getAdmin();
            if (!$admin || !$admin->validatePassword($this->password)) {
                $this->addError($attribute, 'Geçersiz email ve/veya şifre.');
            } else {
                if ($admin && $admin->status != Admin::STATUS_ACTIVE) {
                    $this->addError('fullname', $admin->statusMessage);
                }
            }
        }
    }

    public function login() {
        if ($this->validate()) {
            $response = AdminLogin::create($this->getAdmin()->id);
            return Yii::$app->user->login($this->getAdmin(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    protected function getAdmin() {
        if ($this->_admin === null) {
            $this->_admin = Admin::findByEmail($this->email);
        }
        return $this->_admin;
    }
    
}