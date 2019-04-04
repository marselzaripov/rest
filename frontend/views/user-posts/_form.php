<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use dosamigos\ckeditor\CKEditorInline;
/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>







<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>



    <?= $form->field($model, 'content')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'full',


    ]) ?>

    <?/*= $form->field($model, 'content')->textarea(['rows' => 6]) */?>

    <?/*= Html::a('Set Image', ['set-image', 'id' => $model->id], ['class' => 'btn btn-default'])*/ ?>

   <a href="/posts/set-image?id=<?=$model->id;?>" class="btn btn-default">Set Image</a>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
