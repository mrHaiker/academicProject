<?php

use yii\db\Migration;

class m160811_220152_create_new_colomn_product extends Migration
{
    public function up()
    {
        $this->dropColumn('product', 'photo');
        $this->addColumn('product', 'image', $this->string());
    }

    public function down()
    {
        $this->addColumn('product', 'photo', $this->string());
        $this->dropColumn('product', 'image');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
