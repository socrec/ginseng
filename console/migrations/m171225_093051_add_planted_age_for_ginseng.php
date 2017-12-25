<?php

use yii\db\Migration;

class m171225_093051_add_planted_age_for_ginseng extends Migration
{
    public function safeUp()
    {
        $this->addColumn('ginseng', 'planted_age', $this->integer(5)->defaultValue(0));
        $this->addColumn('draft_ginseng', 'planted_age', $this->integer(5)->defaultValue(0));
    }

    public function safeDown()
    {
        echo "m171225_093051_add_planted_age_for_ginseng cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171225_093051_add_planted_age_for_ginseng cannot be reverted.\n";

        return false;
    }
    */
}
