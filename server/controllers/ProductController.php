<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 10.08.2016
 * Time: 17:10
 */

namespace app\controllers;


use yii\filters\AccessControl;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\ContentNegotiator;
use yii\filters\Cors;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;
use yii\web\Response;

class ProductController extends ActiveController
{
    public $modelClass = 'app\models\Product';

//    public function behaviors()
//    {
//        $behaviors = parent::behaviors();
//        $behaviors['contentNegotiator'] = [
//            'class' => ContentNegotiator::className(),
//            'formats' => [
//                'application/json' => Response::FORMAT_JSON,
//            ],
//        ];
//        $behaviors['authenticator'] = [
//            'class' => HttpBearerAuth::className()
//        ];
//        $behaviors['access'] = [
//            'class' => AccessControl::className(),
//            'only' => ['index', 'view'],
//            'rules' => [
//                [
//                    'actions' => ['index', 'view'],
//                    'allow' => true,
//                    'roles' => ['@'],
//                ],
//            ],
//        ];
//        return $behaviors;
//    }

    public function actions()
    {
        $actions = parent::actions();

        // отключить действия "delete"
        unset($actions['delete']);

        return $actions;
    }

    public function actionTest()
    {
        return 'test';
    }
}