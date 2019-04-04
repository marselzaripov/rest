<?php

namespace frontend\controllers;

use common\rbac\Rbac;
use common\models\User;
use Yii;
use common\models\Post;
use frontend\models\PostSearch;
use common\models\Comment;
use common\models\CommentForm;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class UserPostsController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'update', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex($user_id)
    {
        $user = $this->findUserModel($user_id);
        $popular = PostSearch::getPopular();
        $recent = PostSearch::getRecent();

        $dataProvider = new ActiveDataProvider([
            'query' => Post::find()->forUser($user->id)->orderBy(['id' => SORT_DESC]),
        ]);

        return $this->render('index', [
            'user' => $user,
            'dataProvider' => $dataProvider,
            'popular'=>$popular,
            'recent'=>$recent,
            'categories'=>$categories,

        ]);
    }

    public function actionView($user_id, $id)
    {
	    $post = Post::findOne($id);
        $popular = PostSearch::getPopular();
        $recent = PostSearch::getRecent();
        $comments = $post->getPostComments();
        $commentForm = new CommentForm();
        $post->viewedCounter();

        //$post->viewedCounter();
        return $this->render('view', [
            'user' => $this->findUserModel($user_id),
            'model' => $this->findPostModel($user_id, $id),
            'post'=>$post,
            'comments'=>$comments,
            'commentForm'=>$commentForm,
            'popular'=>$popular,
            'recent'=>$recent,
            'categories'=>$categories,
            
        ]);
    }

    public function actionCreate($user_id)
    {
        $user = $this->findUserModel($user_id);

        if ($user->id != Yii::$app->user->id) {
            throw new ForbiddenHttpException('Forbidden.');
        }

        $model = new Post();
        $model->user_id = $user_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'user_id' => $user->id, 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'user' => $user,
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($user_id, $id)
    {
        $user = $this->findUserModel($user_id);
        $model = $this->findPostModel($user_id, $id);

        if (!Yii::$app->user->can(Rbac::MANAGE_POST, ['post' => $model])) {
            throw new ForbiddenHttpException('Forbidden.');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'user_id' => $user->id, 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'user' => $user,
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($user_id, $id)
    {
        $user = $this->findUserModel($user_id);
        $model = $this->findPostModel($user_id, $id);

        if (!Yii::$app->user->can(Rbac::MANAGE_POST, ['post' => $model])) {
            throw new ForbiddenHttpException('Forbidden.');
        }

        $model->delete();

        return $this->redirect(['index', 'user_id' => $user->id]);
    }

    /**
     * @param integer $user_id
     * @return User the loaded model
     * @throws NotFoundHttpException
     */
    private function findUserModel($user_id)
    {
        if (($model = User::findOne($user_id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @param integer $user_id
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException
     */
    private function findPostModel($user_id, $id)
    {
        if (($model = Post::find()->forUser($user_id)->andWhere(['id' => $id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    

    
}
