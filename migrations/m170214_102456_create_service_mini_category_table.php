<?php

use yii\db\Migration;

class m170214_102456_create_service_mini_category_table extends Migration
{
    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function up()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable('service_mini_category', [
            'id' => $this->primaryKey(11),
            'name' => $this->string(255)->notNull(),
            'parent_category' => $this->integer(11),
            'sort' => $this->integer(11),
        ],$tableOptions);
    }


    public function down()
    {
        $this->dropTable('service_mini_category');
    }
}
