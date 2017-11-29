<?php

use yii\db\Migration;

/**
 * Handles the creation of table `articles`.
 */
class m171127_095031_create_articles_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article', [
            'id' => $this->bigPrimaryKey(32),
            'title' => $this->string(100),
            'content' => $this->text(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
            'created_by' => $this->bigInteger(32),
            'updated_by' => $this->bigInteger(32),
            'is_deleted' => $this->boolean(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article');
    }
}
