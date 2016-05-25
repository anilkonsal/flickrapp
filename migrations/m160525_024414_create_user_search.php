<?php

use yii\db\Migration;

class m160525_024414_create_user_search extends Migration
{
    public function up()
    {
        $this->createTable('user_search', [
            'id' => $this->primaryKey(),
            'user_id'   => $this->integer(),
            'term'  => $this->string(),
            'created_at'    => $this->integer(),
            'updated_at'    => $this->integer(),
        ]);
    }

    public function down()
    {
        $this->dropTable('user_search');
    }
}
