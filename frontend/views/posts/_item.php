<?php

use common\rbac\Rbac;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
?>
<!--
<div class="panel panel-default">
    <div class="panel-heading">
        <?= Html::a(Html::encode($model->title), ['user-posts/view', 'user_id' => $model->user_id, 'id' => $model->id]) ?>
    </div>
    <div class="panel-body">
        <?= Yii::$app->formatter->asNtext(StringHelper::truncateWords($model->content, 50)) ?>
    </div>
</div>
-->

<article class="post">
    <?if($model->getImage()!==""):?>
    <div class="post-thumb">
        <a href="<?= Url::toRoute(['user-posts/view', 'user_id' => $model->user_id, 'id' => $model->id]);?>"><img src="<?= $model->getImage();?>" alt=""></a>

        <a href="<?= Url::toRoute(['user-posts/view', 'user_id' => $model->user_id, 'id' => $model->id]);?>" class="post-thumb-overlay text-center">
            <div class="text-uppercase text-center">View Post</div>
        </a>
    </div>
    <?endif;?>
    <div class="post-content">
        <header class="entry-header text-center text-uppercase">
            <h6><a href="posts/category?id=<?= $model->category->id;?>"> <?= $model->category->title; ?></a></h6>

            <h1 class="entry-title"><a href="<?= Url::toRoute(['user-posts/view', 'user_id' => $model->user_id, 'id' => $model->id]);?>"><?= $model->title?></a></h1>


        </header>
        <div class="entry-content">
            <p><?= $model->content?>
            </p>

            <div class="btn-continue-reading text-center text-uppercase">
                <?= Html::a(Html::encode(Подробнее), ['user-posts/view', 'user_id' => $model->user_id, 'id' => $model->id], ['class' => 'more-link']) ?>

            </div>
        </div>
        <div class="social-share">
            <span class="social-share-title pull-left text-capitalize">By <?= $model->author->username; ?> On <?= $model->getDate();?></span>
            <ul class="text-center pull-right">
                <li><a class="s-facebook" href="#"><i class="fa fa-eye"></i></a></li><?= (int) $model->viewed?>
            </ul>
        </div>
    </div>
</article>