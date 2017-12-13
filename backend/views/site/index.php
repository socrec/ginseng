<?php
use yii\helpers\Html;
use common\constant\Auth;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Xin chào <?= Yii::$app->user->identity->username ?></h1>

        <p class="lead">Hôm nay là ngày <?= date('d') ?> tháng <?= date('m') ?> năm <?= date('Y') ?></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <?php if (Yii::$app->user->can(Auth::PERM_VIEW_DRAFT)) : ?>
                    <h2>Bản Nháp</h2>

                    <p>
                        Số lượng: <b><?= $info->draft['all'] ?></b> bản <br/>
                        Số lượng đã xử lý: <b><?= $info->draft['done'] ?></b> bản <br>
                        Số lượng chưa xử lý: <b class="not-set"><?= $info->draft['not_done'] ?></b> bản
                    </p>

                    <p><?= Html::a('Danh Sách', ['draft/index'], [
                            'class' => 'btn btn-default'
                        ]) ?></p>
                <?php endif; ?>
            </div>
            <div class="col-lg-4">
                <h2>Sâm</h2>

                <p>
                    Số lượng: <b><?= $info->panax['all'] ?></b> cây <br/>
                    <?php if (Yii::$app->user->can(Auth::ROLE_ADMIN)) : ?>
                        Số lượng chưa xuất: <b><?= $info->panax['instock'] ?></b> cây <br>
                        Số lượng đã xuất: <b><?= $info->panax['sold'] ?></b> cây <br>
                        Số lượng cây chết: <b><?= $info->panax['dead'] ?></b> cây
                    <?php endif; ?>
                </p>

                <p><?= Html::a('Danh Sách', ['panax/index'], [
                        'class' => 'btn btn-default'
                    ]) ?></p>
            </div>
            <?php if (Yii::$app->user->can(Auth::PERM_VIEW_ARTICLE)) : ?>
            <div class="col-lg-4">
                <h2>Bài Viết</h2>

                <p>Số lượng bài viết: <b><?= $info->article['all'] ?></b> bài</p>

                <p><?= Html::a('Danh Sách', ['article/index'], [
                        'class' => 'btn btn-default'
                    ]) ?></p>
            </div>
            <?php endif; ?>
        </div>

    </div>
</div>
