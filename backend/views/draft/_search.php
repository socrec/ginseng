<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\DraftGinsengSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="draft-ginseng-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ginseng_id') ?>

    <?= $form->field($model, 'origin') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'planted_by') ?>

    <?php // echo $form->field($model, 'planted_at') ?>

    <?php // echo $form->field($model, 'weight') ?>

    <?php // echo $form->field($model, 'garden_no') ?>

    <?php // echo $form->field($model, 'line_no') ?>

    <?php // echo $form->field($model, 'parent_code') ?>

    <?php // echo $form->field($model, 'how_to_use') ?>

    <?php // echo $form->field($model, 'notice') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'deleted_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
