<?php
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;
use yii\helpers\Url;
use kartik\helpers\Html;
/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Panax Vietnamensis');
?>
<div class="site-index">

    <div class="jumbotron">
        <h1 class="typograph-heading" style="letter-spacing: 7px;"><?= mb_strtoupper(Yii::t('app', 'Panax Vietnamensis')) ?></h1>

        <p class="lead">Khẩu hiệu gì đó hay ho sẽ để ở đây</p>
        <br>
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <?= Select2::widget([
            'name' => 'state_2',
            'value' => '',
            'theme' => Select2::THEME_BOOTSTRAP,
            'size' => Select2::LARGE,
            'addon' => [
                'prepend' => [
                    'content' => Html::icon('globe')
                ],
                'append' => [
                    'content' => Html::button(Html::icon('search'), [
                            'class' => 'btn btn-default',
                            'title' => 'Search',
                            'data-toggle' => 'search'
                        ]),
                    'asButton' => true
                ]
            ],
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
        <?php ActiveForm::end(); ?>

<!--        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>-->
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2 class="typograph-heading">Heading</h2>

                <p style="text-align: justify;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2 class="typograph-heading">Heading</h2>

                <p style="text-align: justify;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2 class="typograph-heading">Heading</h2>

                <p style="text-align: justify;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
