<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\constant\App;
use common\constant\Auth;

/* @var $this yii\web\View */
/* @var $searchModel common\models\GinsengSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Panax');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ginseng-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="col-lg-12">
        <?php if (Yii::$app->session->hasFlash('alert')): ?>
            <div class="alert alert-dismissable alert-success" role="alert">
                <?= Yii::$app->session->getFlash('alert') ?>
            </div>
        <?php endif; ?>
    </div>
    <p>
        <?php if (getUserRoleName() == Auth::ROLE_ADMIN): ?>
            <?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
        <?php else: ?>
            <?= Html::a(Yii::t('app', 'Create'), ['draft/create'], ['class' => 'btn btn-success']) ?>
        <?php endif; ?>
    </p>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'code',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model->statusText;
                },
                'filter' => [
                    App::PANAX_STATUS_AVAILABLE => Yii::t('app/panax', 'Available'),
                    App::PANAX_STATUS_SOLD => Yii::t('app/panax', 'Sold'),
                    App::PANAX_STATUS_SLEPT => Yii::t('app/panax', 'Slept'),
                    App::PANAX_STATUS_SICK => Yii::t('app/panax', 'Sick'),
                    App::PANAX_STATUS_DEAD => Yii::t('app/panax', 'Dead'),
                ],
            ],
            array(
                'attribute' => 'age',
                'label' => Yii::t('app', 'Age'),
                'value' => function ($model) {
                    return $model->currentAge;
                }
            ),
            'garden_no',
            'line_no',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} ' . (Yii::$app->user->can(Auth::PERM_DELETE_GINSENG) ? '{delete}' : ''),
                'buttons' => [
                    'update' => function ($url, $model) {
                        if (Yii::$app->user->can(Auth::PERM_EDIT_GINSENG)) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                'title' => Yii::t('app', 'Edit'),
                            ]);
                        } elseif (Yii::$app->user->can(Auth::PERM_ADD_DRAFT)) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['draft/update', 'id' => $model->id], [
                                'title' => Yii::t('app', 'Edit'),
                            ]);
                        }
                    }
                ]
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
