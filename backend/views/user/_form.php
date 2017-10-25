<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\constant\Auth;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if($model->isNewRecord) { ?>
    <?= $form->field($model, 'username')->textInput() ?>
    <?= $form->field($model, 'role')->dropDownList([
            Auth::ROLE_CONTRIBUTOR => ucfirst(Auth::ROLE_CONTRIBUTOR),
            Auth::ROLE_ADMIN => ucfirst(Auth::ROLE_ADMIN)
        ]) ?>
    <?= $form->field($model, 'password_1st')->passwordInput() ?>
    <?= $form->field($model, 'password_2nd')->passwordInput() ?>
    <?php } else { ?>
    <?php } ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::button('Back', [
            'class' => 'btn btn-default',
            'onclick' => 'window.history.back();'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
