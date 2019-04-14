<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comment`.
 */
class m170124_021622_create_comment_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('comment', [
            'id' => $this->primaryKey(),
            'text'=>$this->string(),
            'user_id'=>$this->integer(),
            'post_id'=>$this->integer(),
            'status'=>$this->integer(),
            'dialog'=>$this->integer()
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-post-user_id',
            'comment',
            'user_id'
        );

        // add foreign key for table `user`
        /*$this->addForeignKey(
            'fk-post-user_id',
            'comment',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );*/

        // creates index for column `article_id`
        $this->createIndex(
            'idx-post_id',
            'comment',
            'post_id'
        );

        // add foreign key for table `article`
       /* $this->addForeignKey(
            'fk-post_id',
            'comment',
            'post_id',
            'post',
            'id',
            'CASCADE'
        );*/
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('comment');
    }
}
