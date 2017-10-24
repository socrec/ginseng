<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Ginseng */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ginseng-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'origin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'planted_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'planted_at')->textInput() ?>

    <?= $form->field($model, 'weight')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'garden_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'line_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'how_to_use')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'notice')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'deleted_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
