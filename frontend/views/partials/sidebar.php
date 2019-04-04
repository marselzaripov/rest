<?php
use yii\helpers\Url;
?>
<div class="col-md-4" style="margin-top: 20px" data-sticky_column>
    <div class="primary-sidebar">

        <aside class="widget">
            <h3 class="widget-title text-uppercase text-center">Топчик</h3>
            <?php

            foreach($popular as $article):?>
                <div class="popular-post">
                    <!--<a href="<?= Url::toRoute(['user-posts/view', 'user_id' => $article->user_id, 'id' => $article->id]);?>" class="popular-img"><img src="<?= $article->getImage();?>" alt="">

                        <div class="p-overlay"></div>
                    </a>-->

                    <div class="p-content">
                        <a href="<?= Url::toRoute(['user-posts/view', 'user_id' => $article->user_id, 'id' => $article->id]);?>" class="text-uppercase"><?= $article->title?></a>
                        <span class="p-date"><?= $article->getDate();?></span>

                    </div>
                </div>
            <?php endforeach;?>

        </aside>
        <aside class="widget pos-padding">
            <h3 class="widget-title text-uppercase text-center">Свежее</h3>
            <?php foreach($recent as $article):?>
                <div class="thumb-latest-posts">
                    <div class="media">
                        <div class="media-left">
                            <!--<a href="<?= Url::toRoute(['user-posts/view', 'user_id' => $article->user_id, 'id' => $article->id]);?>" class="popular-img"><img src="<?= $article->getImage();?>" alt="">
                                <div class="p-overlay"></div>
                            </a>-->
                        </div>
                        <div class="p-content">
                            <a href="<?= Url::toRoute(['user-posts/view', 'user_id' => $article->user_id, 'id' => $article->id]);?>" class="text-uppercase"><?= $article->title?></a>
                            <span class="p-date"><?= $article->getDate();?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
        </aside>
        <aside class="widget border pos-padding">
            <h3 class="widget-title text-uppercase text-center">Категории</h3>
            <ul>
                <?php foreach($categories as $category):?>
                    <li>
                        <a href="posts/category?id=<?=$category->id;?>"><?= $category->title?></a>
                        <span class="post-count pull-right"> (<?= $category->getPostsCount();?>)</span>
                    </li>
                <?php endforeach;?>

            </ul>
        </aside>
    </div>
</div>