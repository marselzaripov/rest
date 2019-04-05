<?php

use common\rbac\Rbac;
use yii\helpers\Html;
use yii\widgets\DetailView;


/* @var $this yii\web\View */
/* @var $user frontend\models\User */
/* @var $model common\models\Post */

$this->title = $model->title;;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['users/index']];
$this->params['breadcrumbs'][] = ['label' => $user->username, 'url' => ['users/view', 'id' => $user->id]];
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index', 'user_id' => $user->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-content">
<div class="container">
<div class="row">
<div class="col-md-8">
<div class="post-view">

    <?php if (Yii::$app->user->can(Rbac::MANAGE_POST, ['post' => $model])): ?>
        <p class="pull-right">
            <?= Html::a('Изменить', ['update', 'user_id' => $model->user_id, 'id' => $model->id], ['class' => 'more-link-1']) ?>
            <?= Html::a('Удалить', ['delete', 'user_id' => $model->user_id, 'id' => $model->id], [
                'class' => 'more-link-1',
                'data' => [
                    'confirm' => 'Вы действительно хотите удалить данную публикацию?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    <?php endif; ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <img src="<?= $model->getImage();?>" alt="">

    <?/*= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) */?>

    <div class="panel">
        <div class="panel-body">
            <?= Yii::$app->formatter->asHtml($model->content) ?>
        </div>
    </div>

             <?= $this->render('/partials/comment', [
                 'post'=>$post,
                 'comments'=>$comments,
                 'commentForm'=>$commentForm,
             ])?>

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
