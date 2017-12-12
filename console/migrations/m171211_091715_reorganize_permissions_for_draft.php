<?php

use yii\db\Migration;
use common\constant\Auth;

class m171211_091715_reorganize_permissions_for_draft extends Migration
{
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        $contributor = $auth->getRole(Auth::ROLE_CONTRIBUTOR);
        $admin = $auth->getRole(Auth::ROLE_ADMIN);

        //Revoke old perms with ginseng
        $perm = $auth->getPermission(Auth::PERM_ADD_GINSENG);
        $auth->removeChild($contributor, $perm);
        $perm = $auth->getPermission(Auth::PERM_EDIT_GINSENG);
        $auth->removeChild($contributor, $perm);

        //add new perm
        $perm = $auth->createPermission(Auth::PERM_ADD_DRAFT);
        $auth->add($perm);
        $auth->addChild($contributor, $perm);

        //Perms for admin
        $perm = $auth->createPermission(Auth::PERM_VIEW_DRAFT);
        $auth->add($perm);
        $auth->addChild($admin, $perm);
        $perm = $auth->createPermission(Auth::PERM_DELETE_DRAFT);
        $auth->add($perm);
        $auth->addChild($admin, $perm);
    }

    public function safeDown()
    {
        echo "m171211_091715_reorganize_permissions_for_draft cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171211_091715_reorganize_permissions_for_draft cannot be reverted.\n";

        return false;
    }
    */
}
