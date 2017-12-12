<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\form\ActiveForm;
use common\constant\Auth;

/* @var $this yii\web\View */
/* @var $model common\models\Ginseng */

$this->title = $model->code;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Panax'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- Sick form Modals -->
<div class="modal fade" id="modal-add-sick" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php $form = ActiveForm::begin(['action' => ['yearly-sick/create'], 'method' => 'POST', 'options' => ['enctype' => 'multipart/form-data']]); ?>
                <div class="modal-body">
                    <?= $form->field($sickModel, 'year_id')->dropDownList($sickModel->yearList) ?>
                    <?= $form->field($sickModel, 'title')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($sickModel, 'medicine')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($sickModel, 'result')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($sickModel, 'desc')->textarea() ?>
                    <?= $form->field($sickModel, 'imageFiles[]')->label(Yii::t('app', 'Image'))->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?= Yii::t('app', 'Close') ?></button>
                    <button type="submit" class="btn btn-primary"><?= Yii::t('app', 'Save') ?></button>
                </div>
            <?php ActiveForm::end(); ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END Sick form Modals -->
<div class="ginseng-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
        if (Yii::$app->user->can(Auth::PERM_DELETE_GINSENG)) {
            echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
        } elseif (Yii::$app->user->can(Auth::PERM_ADD_DRAFT)) {
            echo Html::a(Yii::t('app', 'Update'), ['draft/update', 'id' => $model->id], ['class' => 'btn btn-primary']);
        }
        ?>
        <?php
        if (Yii::$app->user->can(Auth::PERM_DELETE_GINSENG)) {
            echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]);
        }
        ?>
    </p>

    <div class="row">
        <div class="col-md-4">
            <div id="carousel-panax" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <?php foreach ($model->images as $index => $image): ?>
                        <li data-target="#carousel-panax" data-slide-to="<?= $index ?>" <?= $index == 0 ? 'class="active"' : '' ?> ></li>
                    <?php endforeach; ?>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <?php foreach ($model->images as $index => $image): ?>
                        <div class="item <?= $index == 0 ? 'active' : '' ?>">
                            <img src="<?= \yii\helpers\Url::to($image->path) ?>">
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-panax" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-panax" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="col-md-8">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'code',
                    'origin',
                    [                                                  // the owner name of the model
                        'attribute' => 'status',
                        'value' => $model->getStatusText(),
                    ],
                    'parent_id',
                    'planted_by',
                    'planted_at',
                    'weight',
                    'garden_no',
                    'line_no',
                    'how_to_use:ntext',
                    'notice:ntext',
                ],
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="section col-md-12">
            <div class="title"><?= Yii::t('app', 'More Info') ?></div>
        </div>
        <div class="col-md-12">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <?php foreach ($model->yearlyDetails as $index => $detail) : ?>
                    <li role="presentation" class="<?= $index == 0 ? 'active' : '' ?>"><a href="#<?= $detail->year ?>" role="tab" data-toggle="tab"><?= $detail->year ?></a></li>
                <?php endforeach; ?>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <?php foreach ($model->yearlyDetails as $index => $detail) : ?>
                    <div role="tabpanel" class="tab-pane <?= $index == 0 ? 'active' : '' ?>" year-id="<?= $detail->id ?>" id="<?= $detail->year ?>">
                        <?= DetailView::widget([
                            'model' => $detail,
                            'attributes' => [
                                'year',
                                'date_raise',
                                'date_sleep',
                                'fertilize_date',
                                'fertilize_brand',
                                'fertilize_amount',
                            ],
                        ]) ?>
                        <div class="sub-section">
                            <div class="title">
                                <?= Yii::t('app', 'Sicks') ?>
                                <button type="button" id="btn-add-sick" onclick="addSick($(this))" class="btn btn-success" data-toggle="modal" data-target="#modal-add-sick">
                                    <?= Yii::t('app', 'Add Row') ?>
                                </button>
                            </div>
                        </div>
                        <div class="sick-list">
                            <?php
                            $dataProvider = new \yii\data\ActiveDataProvider([
                                'query' => $detail->getSicks(),
                            ]);
                            ?>
                            <?= \yii\grid\GridView::widget([
                                'dataProvider' => $dataProvider,
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    'title',
                                    'medicine',
                                    'result',
                                    'desc:ntext',
//                                    ['class' => 'yii\grid\ActionColumn'],
                                ],
                            ]); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</div>

<?php $this->beginBlock('scripts') ?>
    <script>
        $(function () {
            addSick = function (btn) {
                var year = btn.parents('.tab-pane').first().attr('year-id');
                $('select#yearlysick-year_id').val(year).change();
            };
        });
    </script>
<?php $this->endBlock(); ?>