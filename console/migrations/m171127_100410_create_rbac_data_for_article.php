<?php

use yii\db\Migration;
use common\constant\Auth;

class m171127_100410_create_rbac_data_for_article extends Migration
{
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        $admin = $auth->getRole(Auth::ROLE_ADMIN);

        $permManageArticle = $auth->createPermission(Auth::PERM_MANAGE_ARTICLE);
        $auth->add($permManageArticle);
        $auth->addChild($admin, $permManageArticle);
        $perm = $auth->createPermission(Auth::PERM_ADD_ARTICLE);
        $auth->add($perm);
        $auth->addChild($permManageArticle, $perm);
        $perm = $auth->createPermission(Auth::PERM_VIEW_ARTICLE);
        $auth->add($perm);
        $auth->addChild($permManageArticle, $perm);
        $perm = $auth->createPermission(Auth::PERM_EDIT_ARTICLE);
        $auth->add($perm);
        $auth->addChild($permManageArticle, $perm);
        $perm = $auth->createPermission(Auth::PERM_DELETE_ARTICLE);
        $auth->add($perm);
        $auth->addChild($permManageArticle, $perm);
    }

    public function safeDown()
    {
        echo "m171127_100410_create_rbac_data_for_article cannot be reverted.\n";

        return false;
    }
}
