<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $price
 * @property string $photo
 *
 * @property ProductImg[] $productImgs
 */
class Product extends \yii\db\ActiveRecord
{
    public $photo;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'price'], 'required'],
            [['price'], 'integer'],
            [['name', 'description', 'photo'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'price' => 'Price',
            'photo' => 'Photo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductImgs()
    {
        return $this->hasMany(ProductImg::className(), ['product_id' => 'id']);
    }

    public static function findProductById($id, $type = null)
    {

        return static::findOne(['id' => $id]);

    }
}
