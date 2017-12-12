<?php

use yii\db\Migration;

class m171212_040556_add_parent_for_draft_ginseng extends Migration
{
    public function safeUp()
    {
        $this->addColumn('draft_ginseng', 'parent_id', $this->bigInteger(32));
        $this->dropColumn('draft_ginseng', 'parent_code');
    }

    public function safeDown()
    {
        echo "m171212_040556_add_parent_for_draft_ginseng cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171212_040556_add_parent_for_draft_ginseng cannot be reverted.\n";

        return false;
    }
    */
}
