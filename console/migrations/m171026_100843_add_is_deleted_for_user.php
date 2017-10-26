<?php

use yii\db\Migration;

class m171026_100843_add_is_deleted_for_user extends Migration
{
    public function safeUp()
    {
        $this->addColumn('user', 'is_deleted', $this->boolean());
    }

    public function safeDown()
    {
        $this->dropColumn('user', 'is_deleted');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171026_100843_add_is_deleted_for_user cannot be reverted.\n";

        return false;
    }
    */
}
