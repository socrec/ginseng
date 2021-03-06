<?php

/* @var $this \yii\web\View */

/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use common\constant\Auth;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title ? $this->title : Yii::t('app', 'Panax Vietnamensis')) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::t('app', 'Panax Vietnamensis'),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        //Panax menu
        if (Yii::$app->user->can(Auth::PERM_VIEW_GINSENG)) {
            $menuItems[] = [
                'label' => Yii::t('app', 'Panax'),
                'items' => [
                    ['label' => Yii::t('app', 'List'), 'url' => ['/panax/index']],
                    '<li class="divider"></li>',
                    //check if have approve draft permission or not
                    Yii::$app->user->can(Auth::PERM_APPROVE_DRAFT) ?
                        ['label' => Yii::t('app', 'Pending Drafts'), 'url' => ['/draft/index']]
                        : ['label' => ''],
                ],
            ];
        }

        //Article menu
        if (Yii::$app->user->can(Auth::PERM_VIEW_ARTICLE)) {
            $menuItems[] = [
                'label' => Yii::t('app', 'Article'),
                'url' => ['article/index']
            ];
        }

        //User menu
        if (Yii::$app->user->can(Auth::PERM_VIEW_USER)) {
            $menuItems[] = [
                'label' => Yii::t('app', 'User'),
                'url' => ['user/index']
            ];
        }

        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Yii::t('app', 'Panax Vietnamensis') ?> <?= date('Y') ?></p>

        <p class="pull-right">Develop by <a target="_blank" href="https://dangnhsite.wordpress.com/">DangNH</a></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<!-- For inject js scripts -->
<?php if (isset($this->blocks['scripts'])) : ?>
    <?= $this->blocks['scripts'] ?>
<?php endif; ?>
