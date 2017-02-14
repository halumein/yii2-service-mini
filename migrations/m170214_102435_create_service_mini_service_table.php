<?php

use yii\db\Migration;

/**
 * Handles the creation of table `service_mini_service`.
 */
class m170214_102435_create_service_mini_service_table extends Migration
{
    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function up()
    {
        $tableOptions = 'ENGINE=InnoDB';
        
        $this->createTable('service_mini_service', [
            'id' => $this->primaryKey(11),
            'name' => $this->string(255)->notNull(),
            'description' => $this->text(800),
            'sort' => $this->integer(10),
        ],$tableOptions
        );
    }

    public function down()
    {
        $this->dropTable('service_mini_service');
    }
}
