<?php if(!empty($comments)):?>

    <?php foreach($comments as $comment):?>
        <div class="bottom-comment"><!--bottom comment-->
            <div class="comment-img">
                <img width="50" class="img-circle" src="/uploads/<? if(!empty($comment->user->image)){echo $comment->user->image;}else{echo "no-image.png";};?>" alt="">
            </div>

            <div class="comment-text">
                <a href="#" class="replay btn pull-right"> Replay</a>
                <h5><?= $comment->user->username;?></h5>

                <p class="comment-date">
                    <?= $comment->getDate();?>
                </p>


                <p class="para"><?= $comment->text; ?></p>
            </div>
        </div>
    <?php endforeach;?>

<?php endif;?>
<!-- end bottom comment-->

<?php if((!Yii::$app->user->isGuest)/*&&(Yii::$app->user->id==$model->user_id)*/):?>
    <div class="leave-comment"><!--leave comment-->
        <h4>Leave a reply</h4>
        <?php if(Yii::$app->session->getFlash('comment')):?>
            <div class="alert alert-success" role="alert">
                <?= Yii::$app->session->getFlash('comment'); ?>
            </div>
        <?php endif;?>
        <?php $form = \yii\widgets\ActiveForm::begin([
            'action'=>['site/comment', 'id'=>$post->id],
            'options'=>['class'=>'form-horizontal contact-form', 'role'=>'form']])?>
        <div class="form-group">
            <div class="col-md-12">
                <?= $form->field($commentForm, 'comment')->textarea(['class'=>'form-control','placeholder'=>'Write Message'])->label(false)?>
            </div>
        </div>
        <button type="submit" class="btn send-btn">Комментировать</button>
        <?php \yii\widgets\ActiveForm::end();?>
    </div><!--end leave comment-->
<?php endif;?>