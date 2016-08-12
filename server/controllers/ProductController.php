<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 10.08.2016
 * Time: 17:10
 */

namespace app\controllers;


use app\models\Product;
use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
use Yii;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\ContentNegotiator;
use yii\rest\ActiveController;
use yii\web\Response;

class ProductController extends ActiveController
{
    public $modelClass = 'app\models\Product';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className()
        ];

        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();

        // отключить действия "delete"
        unset($actions['delete']);

        return $actions;
    }

    public function actionUpload()
    {
        $file = $_FILES['file'];
        $tempName = $file['tmp_name'];

        $headers = Yii::$app->request->headers;
        $idProduct = $headers->get('id-product');

        $product = new Product();
        $current = $product::findProductById($idProduct);

        if(!empty($file)) {
            $fileName = static::generateAvatarName($product->photo);
            $fileFullName = \Yii::getAlias('@app/web/images/product/' . $fileName);
            $imagine = new Imagine();
            $imagine->open($tempName)
                ->save($fileFullName . '-original.jpg')
                ->thumbnail(new Box(1000, 1000), ImageInterface::THUMBNAIL_INSET)
                ->save($fileFullName . '-big.jpg')
                ->thumbnail(new Box(700, 700), ImageInterface::THUMBNAIL_INSET)
                ->save($fileFullName . '-mid.jpg')
                ->thumbnail(new Box(400, 400), ImageInterface::THUMBNAIL_INSET)
                ->save($fileFullName . '-small.jpg')
                ->thumbnail(new Box(150, 150), ImageInterface::THUMBNAIL_OUTBOUND)
                ->save($fileFullName . '-thumb.jpg');

            $current->image = $fileName;
            $current->save();
        }

        return [$current];
    }


    public static function generateAvatarName($file) {
        $fileName = hash('crc32', $file->name . time());
        if(file_exists(\Yii::getAlias('@app/web/images/product/') . $fileName . '-original.jpg')) {
            return static::generateAvatarName($file);
        }
        return $fileName;
    }
}