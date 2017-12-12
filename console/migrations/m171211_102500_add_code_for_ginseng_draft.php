<?php

use yii\db\Migration;

class m171211_102500_add_code_for_ginseng_draft extends Migration
{
    public function safeUp()
    {
        $this->addColumn('draft_ginseng', 'code', $this->string(200));
    }

    public function safeDown()
    {
        echo "m171211_102500_add_code_for_ginseng_draft cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171211_102500_add_code_for_ginseng_draft cannot be reverted.\n";

        return false;
    }
    */
}
