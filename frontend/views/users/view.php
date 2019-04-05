<?php

use common\rbac\Rbac;
use frontend\widgets\LastUserPosts;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-content">
<div class="container">
<div class="row">
<div class="col-md-8">
<div class="user-view">

    <?php if (Yii::$app->user->can(Rbac::MANAGE_PROFILE, ['user' => $model])): ?>
        <p class="pull-right">
            <?= Html::a('Профиль', ['profile/index'], ['class' => 'more-link-1']) ?>
        </p>
    <?php endif; ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="panel panel-default">
        <div class="panel-body">
            <?= Yii::$app->formatter->asNtext($model->description) ?>
        </div>
    </div>

    <p class="pull-right">
        <?= Html::a('Новая статья', ['user-posts/create', 'user_id' => $model->id], ['class' => 'more-link-1']) ?>
    </p>

    <h2>My Recent Posts</h2>

    <?= LastUserPosts::widget([
            'user' => $model,
    ]) ?>

</div>
</div>
      <?= $this->render('/partials/sidebar', [
                    'popular'=>$popular,
                    'recent'=>$recent,
                    'categories'=>$categories
                ]);?>
                </div>
                
</div>
</div>
