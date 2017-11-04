<?php

use yii\db\Migration;

class m171104_103015_fix_fertilize_brand_column_type extends Migration
{
    public function safeUp()
    {
        $this->alterColumn('yearly_detail', 'fertilize_brand', $this->string(200));
        $this->alterColumn('draft_year', 'fertilize_brand', $this->string(200));
    }

    public function safeDown()
    {
        echo "m171104_103015_fix_fertilize_brand_column_type cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171104_103015_fix_fertilize_brand_column_type cannot be reverted.\n";

        return false;
    }
    */
}
