<?php

use yii\db\Migration;

class m160809_115212_create_primaryKey_profile extends Migration
{

    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->addForeignKey(
            'profile:user_id',
            'profile',
            'user_id',
            'users',
            'id',
            'cascade',
            'cascade'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('profile:user_id', 'profile');
    }
}
