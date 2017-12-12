<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\constant\Auth;
/* @var $this yii\web\View */
/* @var $searchModel common\models\DraftGinsengSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Draft');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="draft-ginseng-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="col-lg-12">
        <?php if (Yii::$app->session->hasFlash('alert')): ?>
            <div class="alert alert-dismissable alert-success" role="alert">
                <?= Yii::$app->session->getFlash('alert') ?>
            </div>
        <?php endif; ?>
    </div>

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => Yii::t('app', 'Original'),
                'value' =>  function ($model) {
                    if ($model->original) {
                        return Html::a($model->original->code, ['panax/view', 'id' => $model->ginseng_id], [
                            'target' => '_blank'
                        ]);
                    }
                    return '<span class="not-set">('. Yii::t('app', 'not set') .')</span>';
                },
                'format' => 'raw'
            ],
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
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {approve} {delete}',
                'buttons' => [
                    'approve' => function ($url, $model) {
                        if (Yii::$app->user->can(Auth::PERM_APPROVE_DRAFT)) {
                            return Html::a('<span class="glyphicon glyphicon-ok"></span>', ['draft/approve', 'id' => $model->id], [
                                'title' => Yii::t('app', 'Approve'),
                            ]);
                        }
                    }
                ]
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
