<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Ginseng */

$this->title = Yii::t('app', 'Update') . ': ' . $model->code;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Panax'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->code, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="ginseng-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'yearlyModel' => $yearlyModel,
    ]) ?>

</div>
