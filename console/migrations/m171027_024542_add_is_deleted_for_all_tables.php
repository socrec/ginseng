<?php

use yii\db\Migration;

class m171027_024542_add_is_deleted_for_all_tables extends Migration
{
    public function safeUp()
    {
        $this->addColumn('draft_ginseng', 'is_deleted', $this->boolean());
        $this->addColumn('draft_sick', 'is_deleted', $this->boolean());
        $this->addColumn('draft_year', 'is_deleted', $this->boolean());
        $this->addColumn('ginseng', 'is_deleted', $this->boolean());
        $this->addColumn('yearly_detail', 'is_deleted', $this->boolean());
        $this->addColumn('yearly_sick', 'is_deleted', $this->boolean());
    }

    public function safeDown()
    {
        echo "m171027_024542_add_is_deleted_for_all_tables cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171027_024542_add_is_deleted_for_all_tables cannot be reverted.\n";

        return false;
    }
    */
}
