<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\constant\App;
use kartik\select2\Select2;
use yii\web\JsExpression;
use yii\helpers\Url;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Ginseng */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ginseng-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

            <?= $form->field($model, 'origin')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'status')->dropDownList([
                App::PANAX_STATUS_AVAILABLE => Yii::t('app/panax', 'Available'),
                App::PANAX_STATUS_SOLD => Yii::t('app/panax', 'Sold'),
                App::PANAX_STATUS_DEAD => Yii::t('app/panax', 'Dead'),
            ]) ?>

            <?= $form->field($model, 'planted_by')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'planted_at')->widget(DatePicker::className(), [
                'options' => ['placeholder' => Yii::t('app', 'Select date...')],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true
                ]
            ]) ?>

            <?= $form->field($model, 'how_to_use')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'parent_id')->widget(Select2::className(), [
                'options' => ['placeholder' => Yii::t('app', 'Search by Code...')],
                'pluginOptions' => [
                    'allowClear' => true,
                    'minimumInputLength' => 2,
                    'ajax' => [
                        'url' => Url::to(['panax/panax-list']),
                        'dataType' => 'json',
                        'data' => new JsExpression('function(params) { return {q:params.term}; }')
                    ],
                    'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                ],
            ]) ?>

            <?= $form->field($model, 'weight')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'garden_no')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'line_no')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'notice')->textarea(['rows' => 6]) ?>
        </div>
    </div>

    <div class="row">
        <div class="section col-md-12">
            <div class="title"><?= Yii::t('app', 'More Info') ?></div>
        </div>
        <div class="multiple-rows parent">
            <div class="child">
                <div class="col-md-6">
                    <?= $form->field($yearlyModel, 'year[]')->widget(Select2::className(), [
                        'data' => App::$years,
                    ]) ?>

                    <?= $form->field($yearlyModel, 'date_raise[]')->widget(DatePicker::className(), [
                        'options' => ['placeholder' => Yii::t('app', 'Select date...')],
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'todayHighlight' => true
                        ]
                    ]) ?>

                    <?= $form->field($yearlyModel, 'date_sleep[]')->widget(DatePicker::className(), [
                        'options' => ['placeholder' => Yii::t('app', 'Select date...')],
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'todayHighlight' => true
                        ]
                    ]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($yearlyModel, 'fertilize_date[]')->widget(DatePicker::className(), [
                        'options' => ['placeholder' => Yii::t('app', 'Select date...')],
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'todayHighlight' => true
                        ]
                    ]) ?>

                    <?= $form->field($yearlyModel, 'fertilize_brand[]')->textInput() ?>

                    <?= $form->field($yearlyModel, 'fertilize_amount[]')->textInput() ?>
                </div>
                <div class="col-md-12 text-center">
                    <a onclick="addRow($(this))" title="<?= Yii::t('app', 'Add Row') ?>" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span></a>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php $this->beginBlock('scripts') ?>
<script>
    function addRow(button) {
        var parent = button.parents('.multiple-rows.parent').first(),
            row = '<div class="child">' +
                    '<div class="col-md-6">' +
                        <?= json_encode($form->field($yearlyModel, 'year[]')->dropDownList(App::$years)->__toString()) ?> +
                        <?= json_encode($form->field($yearlyModel, 'date_raise[]')->widget(DatePicker::className(), [
                            'options' => ['placeholder' => Yii::t('app', 'Select date...')],
                            'pluginOptions' => [
                                'format' => 'yyyy-mm-dd',
                                'todayHighlight' => true
                            ]
                        ])->__toString()) ?> +
                        <?= json_encode($form->field($yearlyModel, 'date_sleep[]')->widget(DatePicker::className(), [
                            'options' => ['placeholder' => Yii::t('app', 'Select date...')],
                            'pluginOptions' => [
                                'format' => 'yyyy-mm-dd',
                                'todayHighlight' => true
                            ]
                        ])->__toString()) ?> +
                    '</div>' +
                    '<div class="col-md-6">' +
                        <?= json_encode($form->field($yearlyModel, 'fertilize_date[]')->widget(DatePicker::className(), [
                            'options' => ['placeholder' => Yii::t('app', 'Select date...')],
                            'pluginOptions' => [
                                'format' => 'yyyy-mm-dd',
                                'todayHighlight' => true
                            ]
                        ])->__toString()) ?> +
                        <?= json_encode($form->field($yearlyModel, 'fertilize_brand[]')->textInput()->__toString()) ?> +
                        <?= json_encode($form->field($yearlyModel, 'fertilize_amount[]')->textInput()->__toString()) ?> +
                    '</div>' +
                    '<div class="col-md-12 text-center">' +
                        '<a onclick="removeRow($(this))" title="<?= Yii::t('app', 'Delete') ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>' +
                    '</div>' +
                '</div>';
        $(parent).append(row);
        //trigger
        $(parent).find('select').last().select2();
        $(parent).find('[name^="YearlyDetail[date_raise]"]').last().kvDatepicker({});
        $(parent).find('[name^="YearlyDetail[date_sleep]"]').last().kvDatepicker({});
        $(parent).find('[name^="YearlyDetail[fertilize_date]"]').last().kvDatepicker({});
    };

    function removeRow(button) {
        var child = button.parent().parent();
        child.remove();
    };
</script>
<?php $this->endBlock() ?>