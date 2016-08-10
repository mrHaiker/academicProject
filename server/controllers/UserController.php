<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 08.08.2016
 * Time: 19:12
 */

namespace app\controllers;


use app\models\LoginForm;
use app\models\RegisterForm;
use Yii;
use yii\rest\Controller;
use yii\web\ServerErrorHttpException;

class UserController extends Controller
{
    /**
     * @return array|string
     * @throws ServerErrorHttpException
     */
    public function actionRegister()
    {
        $model = new RegisterForm();

        if($model->load(\Yii::$app->request->getBodyParams(), '') && $model->validate()) {
            var_dump($model->username);
            if($model->register()) {
                return $model->username . 'User successfully register';
            } else {
                throw new ServerErrorHttpException('Register failed for unknown reason');
            }
        } else {
            return $model->getErrors();
        }
    }

    /**
     * @return LoginForm|array
     */
    public function actionLogin() {
        $model = new LoginForm();
        if ($model->load(\Yii::$app->getRequest()->getBodyParams(), '') && $model->validate()) {
            if($model->login()) {
                return ['access_token' => \Yii::$app->user->identity->getAuthKey()];
            }
        }
        return $model;
    }

    protected function verbs()
    {
        return [
            'register' => ['POST'],
            'login' => ['POST'],
        ];
    }
}