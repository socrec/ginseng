<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\GinsengSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ginsengs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ginseng-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ginseng', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'code',
            'origin',
            'status',
            'planted_by',
            // 'planted_at',
            // 'weight',
            // 'garden_no',
            // 'line_no',
            // 'parent_code',
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
<?php Pjax::end(); ?></div>