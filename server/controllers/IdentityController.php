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
use yii\filters\auth\HttpBearerAuth;
use yii\rest\Controller;
use yii\web\UploadedFile;

class IdentityController extends Controller
{

    
    public function actionEdit()
    {

        /** @var User $user */
        $user = \Yii::$app->user->identity;

        $profile = $user->profile;

        if(empty($profile)) {
            $profile = new Profile();
        }

        if(\Yii::$app->request->isPost) {

            var_dump(\Yii::$app->getRequest()->getBodyParams(), '');

            if($profile->load(\Yii::$app->getRequest()->getBodyParams(), '')) {
                $profile->avatarFile = UploadedFile::getInstance($profile, 'avatarFile');
                if($profile->validate()) {
                    var_dump($profile->avatarFile);
                    if(!empty($profile->avatarFile)) {
                        var_dump('avatar');
                        $fileName = static::generateAvatarName($profile->avatarFile);
                        $fileFullName = \Yii::getAlias('@app/web/images/avatars/' . $fileName);
                        $imagine = new Imagine();
                        $imagine->open($profile->avatarFile->tempName)
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
                    }
                    $profile->user_id = $user->id;
                    $profile->save();
                }
            }
        }

        return $profile;
    }

    public static function generateAvatarName($file) {
        $fileName = hash('crc32', $file->name . time());
        if(file_exists(\Yii::getAlias('@app/web/images/avatars/') . $fileName . '-original.jpg')) {
            return static::generateAvatarName($file);
        }
        return $fileName;
    }
}