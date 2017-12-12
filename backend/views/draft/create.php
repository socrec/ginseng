<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\DraftGinseng */

$this->title = Yii::t('app', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Panax'), 'url' => ['panax/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="draft-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', compact('model', 'yearlyModel')) ?>

</div>
