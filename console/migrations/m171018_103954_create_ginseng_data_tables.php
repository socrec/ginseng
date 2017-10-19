<?php

use yii\db\Migration;

class m171018_103954_create_ginseng_data_tables extends Migration
{
    public function safeUp()
    {
        $this->createTable('ginseng', [
            'id' => $this->bigPrimaryKey(32),
            'code' => $this->string(200)->notNull()->unique(),
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

        $this->createTable('yearly_detail', [
            'id' => $this->bigPrimaryKey(32),
            'ginseng_id' => $this->bigInteger(32),
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

        $this->createTable('yearly_sick', [
            'id' => $this->bigPrimaryKey(32),
            'year_id' => $this->bigInteger(32),
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

        $this->createTable('image', [
            'path' => $this->string(300),
            'object_type' => $this->string(50),
            'object_id' => $this->bigInteger(32),
        ]);
        $this->createIndex(
            'idx-image-object_id',
            'image',
            'object_id'
        );
    }

    public function safeDown()
    {
        echo "m171018_103954_create_ginseng_data_tables cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171018_103954_create_ginseng_data_tables cannot be reverted.\n";

        return false;
    }
    */
}
