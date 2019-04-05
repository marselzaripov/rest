<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Профиль';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['users/index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['users/view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update'], ['class' => 'more-link-1']) ?>
        <?= Html::a('Удалить', ['delete'], [
            'class' => 'more-link-1',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'email:email',
            'created_at:datetime',
            'description:ntext',
        ],
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
</div>
