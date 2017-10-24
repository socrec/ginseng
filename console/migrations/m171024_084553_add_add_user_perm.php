<?php

use yii\db\Migration;
use common\constant\Auth;

class m171024_084553_add_add_user_perm extends Migration
{
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $permManageUser = $auth->getPermission(Auth::PERM_MANAGE_USER);

        $perm = $auth->createPermission(Auth::PERM_ADD_USER);
        $auth->add($perm);
        $auth->addChild($permManageUser, $perm);
    }

    public function safeDown()
    {

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171024_084553_add_add_user_perm cannot be reverted.\n";

        return false;
    }
    */
}
