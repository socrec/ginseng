<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\DraftGinseng */

$this->title = 'Create Draft Ginseng';
$this->params['breadcrumbs'][] = ['label' => 'Draft Ginsengs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="draft-ginseng-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
