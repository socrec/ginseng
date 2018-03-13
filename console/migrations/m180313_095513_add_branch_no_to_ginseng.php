<?php

use yii\db\Migration;

class m180313_095513_add_branch_no_to_ginseng extends Migration
{
    public function safeUp()
    {
        $this->addColumn('ginseng', 'branch_no', $this->integer(10));
    }

    public function safeDown()
    {
        $this->dropColumn('ginseng', 'branch_no');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180313_095513_add_branch_no_to_ginseng cannot be reverted.\n";

        return false;
    }
    */
}
