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
        <?php if(Yii::$app->session->hasFlash('alert')): ?>
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
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'code',
            'origin',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model->statusText;
                }
            ],
            'planted_by',
            'planted_at',
            'weight',
            'garden_no',
            'line_no',
            [
                'attribute' => 'parent_id',
                'value' => function ($model) {
                    return $model->parent ? $model->parent->code : null;
                }
            ],
            // 'how_to_use:ntext',
            // 'notice:ntext',
            // 'created_at',
            // 'updated_at',
            // 'deleted_at',
            // 'created_by',
            // 'updated_by',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
