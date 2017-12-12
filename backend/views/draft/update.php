<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DraftGinseng */
/* @var $yearlyModel common\models\DraftYear */

$this->title = Yii::t('app', 'Update') . ': ' . $model->code;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Panax'), 'url' => ['panax/index']];
$this->params['breadcrumbs'][] = ['label' => $model->code, 'url' => ['panax/view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="ginseng-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'yearlyModel' => $yearlyModel,
    ]) ?>

</div>
