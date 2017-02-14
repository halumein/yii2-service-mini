<?php

use yii\db\Migration;

/**
 * Handles the creation of table `service_mini_service_to_category`.
 */
class m170214_102515_create_service_mini_service_to_category_table extends Migration
{
    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function up()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable('service_mini_service_to_category', [
            'id' => $this->primaryKey(11),
            'service_id' => $this->integer(11)->notNull(),
            'category_id' => $this->integer(11)->notNull(),
            'price' => $this->decimal(12, 2)->notNull(),
            'max_discount' => $this->decimal(12, 2),
            'description' => $this->string(255),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('service_mini_service_to_category');
    }
}
