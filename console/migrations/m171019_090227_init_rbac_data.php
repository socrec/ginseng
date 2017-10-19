<?php

use yii\db\Migration;
use common\constant\Auth;

class m171019_090227_init_rbac_data extends Migration
{
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $admin = $auth->createRole(Auth::ROLE_ADMIN);
        $auth->add($admin);
        //assign for admin
        $user = \common\models\User::findByUsername('admin');
        if ($user && $user->id) {
            $auth->assign($admin, $user->id);
        }
        $contributor = $auth->createRole(Auth::ROLE_CONTRIBUTOR);
        $auth->add($contributor);

        //User
        $permManageUser = $auth->createPermission(Auth::PERM_MANAGE_USER);
        $auth->add($permManageUser);
        $auth->addChild($admin, $permManageUser);
        $perm = $auth->createPermission(Auth::PERM_VIEW_USER);
        $auth->add($perm);
        $auth->addChild($permManageUser, $perm);
        $perm = $auth->createPermission(Auth::PERM_EDIT_USER);
        $auth->add($perm);
        $auth->addChild($permManageUser, $perm);
        $perm = $auth->createPermission(Auth::PERM_DELETE_USER);
        $auth->add($perm);
        $auth->addChild($permManageUser, $perm);
        $perm = $auth->createPermission(Auth::PERM_APPROVE_USER);
        $auth->add($perm);
        $auth->addChild($permManageUser, $perm);

        //Draft
        $perm = $auth->createPermission(Auth::PERM_APPROVE_DRAFT);
        $auth->add($perm);
        $auth->addChild($admin, $perm);

        //Ginseng
        $permManageGinseng = $auth->createPermission(Auth::PERM_MANAGE_GINSENG);
        $auth->add($permManageGinseng);
        $auth->addChild($admin, $permManageGinseng);
        $perm = $auth->createPermission(Auth::PERM_VIEW_GINSENG);
        $auth->add($perm);
        $auth->addChild($permManageGinseng, $perm);
        $auth->addChild($contributor, $perm);
        $perm = $auth->createPermission(Auth::PERM_ADD_GINSENG);
        $auth->add($perm);
        $auth->addChild($permManageGinseng, $perm);
        $auth->addChild($contributor, $perm);
        $perm = $auth->createPermission(Auth::PERM_DELETE_GINSENG);
        $auth->add($perm);
        $auth->addChild($permManageGinseng, $perm);
        $perm = $auth->createPermission(Auth::PERM_EDIT_GINSENG);
        $auth->add($perm);
        $auth->addChild($permManageGinseng, $perm);
        $auth->addChild($contributor, $perm);
    }

    public function safeDown()
    {
        echo "m171019_090227_init_rbac_data cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171019_090227_init_rbac_data cannot be reverted.\n";

        return false;
    }
    */
}
