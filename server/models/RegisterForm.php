<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 08.08.2016
 * Time: 19:10
 */

namespace app\models;


use yii\base\Model;

class RegisterForm extends Model
{
    public $username;
    public $password;
    public $cpassword;
    public function rules()
    {
        return [
            [['username', 'password', 'cpassword'], 'required'],
            [['username'], 'unique', 'targetAttribute' => 'username', 'targetClass' => 'app\models\User'],
            [['cpassword'], 'compare', 'compareAttribute' => 'password']
        ];
    }
    public function register() {
        if($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->password = md5($this->password);
            if($user->save()) {
                return true;
            }
        }
        return false;
    }
}