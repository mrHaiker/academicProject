<?php

use yii\db\Migration;

class m160809_114507_create_profile_tabel extends Migration
{

    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->createTable('profile', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'avatar' => $this->string(),
            'email' => $this->string(),
            'first_name' => $this->string(),
            'last_name' => $this->string(),
            'phone_number' => $this->string()
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('profile');
    }
}
