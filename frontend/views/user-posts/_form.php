<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use dosamigos\ckeditor\CKEditorInline;
use common\models\Category;
use yii\helpers\ArrayHelper;
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

    <?

    $categories = Category::find()->all();
    $items = ArrayHelper::map($categories,'id','title');
    $params = [
        'prompt' => 'Укажите категорию'
    ];
    echo $form->field($model, 'category_id')->dropDownList($items,$params);
    ?>


   <a href="/posts/set-image?id=<?=$model->id;?>" class="btn btn-default">Добавить изображение</a>

   <?= $form->field($model, 'date')->hiddenInput(['readonly' => true, 'value' => date("Y.m.d")]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
