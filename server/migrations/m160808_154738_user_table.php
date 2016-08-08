<?php

use yii\db\Migration;

class m160808_154738_user_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('users', [
            'id'=> $this->primaryKey(),
            'username'=> $this->string(40)->notNull(),
            'password' => $this->string(40)->notNull(),
            'access_key' => $this->string(),
            'last_access' => $this->dateTime(),
            'created_at' => $this->dateTime()
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('users');
    }
}
