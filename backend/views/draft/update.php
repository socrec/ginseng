<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DraftGinseng */

$this->title = 'Update Draft Ginseng: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Draft Ginsengs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="draft-ginseng-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
