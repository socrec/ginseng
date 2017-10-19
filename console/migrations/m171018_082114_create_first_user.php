<?php

use yii\db\Migration;

class m171018_082114_create_first_user extends Migration
{
    public function safeUp()
    {
        $model = new \common\models\User();
        $model->username = 'admin';
        $model->password_hash = Yii::$app->security->generatePasswordHash('123@123a');
        $model->generateAuthKey();
        $model->email = 'admin@admin.com';
        $model->save();
    }

    public function safeDown()
    {
        echo "m171018_082114_create_first_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171018_082114_create_first_user cannot be reverted.\n";

        return false;
    }
    */
}
