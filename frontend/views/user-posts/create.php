<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $model common\models\Post */

$this->title = 'Опубликовать статью';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['users/index']];
$this->params['breadcrumbs'][] = ['label' => $user->username, 'url' => ['users/view', 'id' => $user->id]];
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index', 'user_id' => $user->id]];
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
					

					    <h1><?= Html::encode($this->title) ?></h1>

					    <?= $this->render('_form', [
					        'model' => $model,
					    ]) ?>

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
