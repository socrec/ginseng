<?php

use yii\db\Migration;

class m171027_080201_change_parent_code_to_parent_id extends Migration
{
    public function safeUp()
    {
        $this->renameColumn('ginseng', 'parent_code', 'parent_id');
        $this->alterColumn('ginseng', 'parent_id', $this->bigInteger(32));
    }

    public function safeDown()
    {
        $this->renameColumn('ginseng', 'parent_id', 'parent_code');
        $this->alterColumn('ginseng', 'parent_code', $this->string(100));
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171027_080201_change_parent_code_to_parent_id cannot be reverted.\n";

        return false;
    }
    */
}
