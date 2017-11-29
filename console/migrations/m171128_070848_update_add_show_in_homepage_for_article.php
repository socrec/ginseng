<?php

use yii\db\Migration;

class m171128_070848_update_add_show_in_homepage_for_article extends Migration
{
    public function safeUp()
    {
        $this->addColumn('article', 'show_on_homepage', $this->boolean());
    }

    public function safeDown()
    {
        echo "m171128_070848_update_add_show_in_homepage_for_article cannot be reverted.\n";

        return false;
    }
}
