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

    <?php if ($model->isNewRecord) { ?>
        <?= $form->field($model, 'username')->textInput() ?>
    <?php } ?>
    <?= $form->field($model, 'email')->textInput() ?>
    <?= $form->field($model, 'role')->dropDownList([
        Auth::ROLE_CONTRIBUTOR => ucfirst(Auth::ROLE_CONTRIBUTOR),
        Auth::ROLE_ADMIN => ucfirst(Auth::ROLE_ADMIN)
    ]) ?>
    <?= $form->field($model, 'password_1st')->passwordInput() ?>
    <?= $form->field($model, 'password_2nd')->passwordInput() ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-success']) ?>
        <?= Html::button('Back', [
            'class' => 'btn btn-default',
            'onclick' => 'window.history.back();'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
