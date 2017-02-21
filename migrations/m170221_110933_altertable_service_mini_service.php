<?php

use yii\db\Migration;

class m170221_110933_altertable_service_mini_service extends Migration
{
    public function up()
    {
        $this->addColumn('{{%service_mini_service}}','parent_id',$this->integer(11)->null()->defaultValue(null));
    }

    public function down()
    {
        $this->dropColumn('{{%service_mini_service}}', 'parent_id');
    }

}
