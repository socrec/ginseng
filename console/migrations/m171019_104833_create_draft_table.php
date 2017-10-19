<?php

use yii\db\Migration;

/**
 * Handles the creation of table `draft`.
 */
class m171019_104833_create_draft_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('draft_ginseng', [
            'id' => $this->bigPrimaryKey(32),
            'ginseng_id' => $this->bigInteger(32),
            'origin' => $this->string(250),
            'status' => $this->integer(1),
            'planted_by' => $this->string(250),
            'planted_at' => $this->date(),
            'weight' => $this->decimal(32, 1),
            'garden_no' => $this->string(5),
            'line_no' => $this->string(5),
            'parent_code' => $this->string(200),
            'how_to_use' => $this->text(),
            'notice' => $this->text(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
            'deleted_at' => $this->dateTime(),
            'created_by' => $this->bigInteger(32),
            'updated_by' => $this->bigInteger(32),
        ]);
        $this->createTable('draft_year', [
            'id' => $this->bigPrimaryKey(32),
            'draft_id' => $this->bigInteger(32),
            'year' => $this->integer(10),
            'date_raise' => $this->date(),
            'date_sleep' => $this->date(),
            'fertilize_date' => $this->date(),
            'fertilize_brand' => $this->date(),
            'fertilize_amount' => $this->string(250),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
            'deleted_at' => $this->dateTime(),
            'created_by' => $this->bigInteger(32),
            'updated_by' => $this->bigInteger(32),
        ]);

        $this->createTable('draft_sick', [
            'id' => $this->bigPrimaryKey(32),
            'draft_year_id' => $this->bigInteger(32),
            'title' => $this->string(250),
            'medicine' => $this->string(250),
            'result' => $this->string(250),
            'desc' => $this->text(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
            'deleted_at' => $this->dateTime(),
            'created_by' => $this->bigInteger(32),
            'updated_by' => $this->bigInteger(32),
        ]);

        $this->createTable('draft_image', [
            'path' => $this->string(300),
            'object_type' => $this->string(50),
            'object_id' => $this->bigInteger(32),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('draft');
    }
}
