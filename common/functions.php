<?php
/**
 * Created by PhpStorm.
 * User: dangnh
 * Date: 10/18/17
 * Time: 2:49 AM
 */

/**
 * Debug function
 * d($var);
 */
function d()
{
    echo '<pre>';
    for ($i = 0; $i < func_num_args(); $i++) {
        yii\helpers\VarDumper::dump(func_get_arg($i), 10, true);
    }
    echo '</pre>';
}

/**
 * Debug function with die() after
 * dd($var);
 */
function dd()
{
    for ($i = 0; $i < func_num_args(); $i++) {
        d(func_get_arg($i));
    }
    die();
}

/**
 * Get current user's role
 * @return bool|string
 */
function getUserRoleName()
{
    $roles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->id);

    if (is_array($roles) && count($roles)) {
        $role = reset($roles);
        return $role->name;
    }
    return false;
}

/**
 * Copy model object data
 * @param $className string
 * @param $model \yii\base\Model
 * @return mixed \yii\base\Model
 */
function cloneModel($className,$model) {
    $attributes = $model->attributes;
    $newObj = new $className;
    foreach($attributes as  $attribute => $val) {
        $newObj->{$attribute} = $val;
    }
    return $newObj;
}