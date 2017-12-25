<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\constant\App;
use kartik\select2\Select2;
use yii\web\JsExpression;
use yii\helpers\Url;
use kartik\date\DatePicker;
use unclead\multipleinput\MultipleInput;

/* @var $this yii\web\View */
/* @var $model common\models\Ginseng */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ginseng-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'origin')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'status')->dropDownList([
                App::PANAX_STATUS_AVAILABLE => Yii::t('app/panax', 'Available'),
                App::PANAX_STATUS_SOLD => Yii::t('app/panax', 'Sold'),
                App::PANAX_STATUS_SLEPT => Yii::t('app/panax', 'Slept'),
                App::PANAX_STATUS_SICK => Yii::t('app/panax', 'Sick'),
                App::PANAX_STATUS_DEAD => Yii::t('app/panax', 'Dead'),
            ]) ?>

            <?= $form->field($model, 'planted_age')->textInput(['maxlength' => true]) ?>

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

            <?= $form->field($model, 'imageFiles[]')->label((isset($model->id) ? Yii::t('app', 'Replace all Image') : Yii::t('app', 'Image')))->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

            <?= $form->field($model, 'notice')->textarea(['rows' => 6]) ?>
        </div>
    </div>

    <div class="row">
        <div class="section col-md-12">
            <div class="title"><?= Yii::t('app', 'More Info') ?></div>
        </div>
        <div class="col-md-12">
            <?php
                $columns = [
                    [
                        'name' => 'year',
                        'type'  => Select2::className(),
                        'title' => $yearlyModel->getAttributeLabel('year'),
                        'options' => [
                            'data' => App::$years,
                            'options' => ['placeholder' => Yii::t('app', 'Select year...')],
                        ]
                    ],
                    [
                        'name' => 'date_raise',
                        'type'  => DatePicker::className(),
                        'title' => $yearlyModel->getAttributeLabel('date_raise'),
                        'options' => [
                            'options' => [
                                'placeholder' => Yii::t('app', 'Select date...'),
                                'style' => 'min-width: 100px',
                            ],
                            'type' => DatePicker::TYPE_INPUT,
                            'pluginOptions' => [
                                'format' => 'yyyy-mm-dd',
                                'todayHighlight' => true,
                            ]
                        ]
                    ],
                    [
                        'name' => 'date_sleep',
                        'type'  => DatePicker::className(),
                        'title' => $yearlyModel->getAttributeLabel('date_sleep'),
                        'options' => [
                            'options' => [
                                'placeholder' => Yii::t('app', 'Select date...'),
                                'style' => 'min-width: 100px',
                            ],
                            'type' => DatePicker::TYPE_INPUT,
                            'pluginOptions' => [
                                'format' => 'yyyy-mm-dd',
                                'todayHighlight' => true,
                            ]
                        ]
                    ],
                    [
                        'name' => 'fertilize_date',
                        'type'  => DatePicker::className(),
                        'title' => $yearlyModel->getAttributeLabel('fertilize_date'),
                        'options' => [
                            'options' => [
                                'placeholder' => Yii::t('app', 'Select date...'),
                                'style' => 'min-width: 100px',
                            ],
                            'type' => DatePicker::TYPE_INPUT,
                            'pluginOptions' => [
                                'format' => 'yyyy-mm-dd',
                                'todayHighlight' => true,
                            ]
                        ]
                    ],
                    [
                        'name'  => 'fertilize_brand',
                        'title' => $yearlyModel->getAttributeLabel('fertilize_brand'),
                        'enableError' => true,
                        'options' => [
                            'class' => 'input-priority',
                            'style' => 'min-width: 100px',
                        ]
                    ],
                    [
                        'name'  => 'fertilize_amount',
                        'title' => $yearlyModel->getAttributeLabel('fertilize_amount'),
                        'enableError' => true,
                        'options' => [
                            'class' => 'input-priority',
                            'style' => 'min-width: 100px',
                        ]
                    ],
                ];
                if ($model->id) {
                    $columns[] = [
                        'name'  => 'id',
                        'type'  => 'hiddenInput',
                    ];
                }
            ?>
            <?= $form->field($model, 'years')->label(false)->widget(MultipleInput::className(), [
                'max' => 4,
                'columns' => $columns
            ]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>