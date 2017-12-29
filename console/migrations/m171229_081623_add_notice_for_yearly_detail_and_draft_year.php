<?php

use yii\db\Migration;

class m171229_081623_add_notice_for_yearly_detail_and_draft_year extends Migration
{
    public function safeUp()
    {
        $this->addColumn('yearly_detail', 'notice', $this->text());
        $this->addColumn('draft_year', 'notice', $this->text());
    }

    public function safeDown()
    {
        echo "m171229_081623_add_notice_for_yearly_detail_and_draft_year cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171229_081623_add_notice_for_yearly_detail_and_draft_year cannot be reverted.\n";

        return false;
    }
    */
}
