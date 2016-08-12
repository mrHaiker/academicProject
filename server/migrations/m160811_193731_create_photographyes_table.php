<?php

use yii\db\Migration;

/**
 * Handles the creation for table `photographyes`.
 */
class m160811_193731_create_photographyes_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('product_img', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'photo' => $this->string()
        ]);
        $this->addForeignKey(
            'product_img:product_id',
            'product_img',
            'product_id',
            'product',
            'id',
            'cascade',
            'cascade'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('product_img');
    }
}
