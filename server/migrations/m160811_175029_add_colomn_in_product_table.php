<?php

use yii\db\Migration;

class m160811_175029_add_colomn_in_product_table extends Migration
{
    public function up()
    {
        $this->addColumn('product', 'photo', $this->string());
    }

    public function down()
    {
        $this->dropColumn('product', 'photo');
    }
}
