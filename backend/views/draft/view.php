<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\DraftGinseng */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Draft Ginsengs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="draft-ginseng-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ginseng_id',
            'origin',
            'status',
            'planted_by',
            'planted_at',
            'weight',
            'garden_no',
            'line_no',
            'parent_code',
            'how_to_use:ntext',
            'notice:ntext',
            'created_at',
            'updated_at',
            'deleted_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
