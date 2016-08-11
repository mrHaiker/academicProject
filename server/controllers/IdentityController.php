<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 09.08.2016
 * Time: 15:05
 */

namespace app\controllers;


use app\models\Profile;
use app\models\User;
use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\ContentNegotiator;
use yii\rest\Controller;
use yii\web\Response;
use yii\web\UploadedFile;

class IdentityController extends Controller
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
//                'application/xml' => Response::FORMAT_XML,
            ],
        ];
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className()
        ];
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'only' => ['index', 'view'],
            'rules' => [
                [
                    'actions' => ['index', 'view'],
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ],
        ];
        return $behaviors;
    }

    public function actionIndex()
    {
        $user = \Yii::$app->user->identity;
        $profile = $user->profile;

        return [$profile];
    }

    public function actionEdit()
    {
        /** @var User $user */
        $user = \Yii::$app->user->identity;

        $profile = $user->profile;

        if(empty($profile)) {
            $profile = new Profile();
        }

        if(\Yii::$app->request->isPost) {

            if($profile->load(\Yii::$app->getRequest()->getBodyParams(), '')) {
                if($profile->validate()) {
                    $profile->user_id = $user->id;
                    $profile->save();
                }
            }
        }

        return $profile;
    }

    public function actionUpload()
    {
        $user = \Yii::$app->user->identity;

        $profile = $user->profile;

        if(empty($profile)) {
            $profile = new Profile();
        }

        $file = $_FILES['file'];
        $tempName = $file['tmp_name'];


        if(!empty($file)) {
            $fileName = static::generateAvatarName($profile->avatarFile);
            $fileFullName = \Yii::getAlias('@app/web/images/avatars/' . $fileName);
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

            $profile->avatar = $fileName;
            $profile->save();
        }

        return [$profile];
    }

    public static function generateAvatarName($file) {
        $fileName = hash('crc32', $file->name . time());
        if(file_exists(\Yii::getAlias('@app/web/images/avatars/') . $fileName . '-original.jpg')) {
            return static::generateAvatarName($file);
        }
        return $fileName;
    }
}