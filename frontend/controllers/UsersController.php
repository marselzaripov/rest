<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use common\models\Category;
use common\models\Post;
use frontend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class UsersController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $popular = Post::getPopular();
        $recent = Post::getRecent();
        $categories = Category::getAll();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'popular'=>$popular,
            'recent'=>$recent,
            'categories'=>$categories,


        ]);
    }

    public function actionView($id)
    {
        $popular = Post::getPopular();
        $recent = Post::getRecent();
        $categories = Category::getAll();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'popular'=>$popular,
            'recent'=>$recent,
            'categories'=>$categories,
        ]);
    }

    /**
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    private function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
