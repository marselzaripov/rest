<?php

namespace frontend\controllers;

use Yii;

use common\models\Post;
use common\models\Category;
use frontend\models\ImageUpload;
use frontend\models\PostSearch;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;



class PostsController extends Controller
{
    public function actionIndex()
    {
       
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $popular = PostSearch::getPopular();
        $recent = PostSearch::getRecent();
       

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'popular'=>$popular,
            'recent'=>$recent,
            'categories'=>$categories,
        ]);




    }
    /*public function actionIndex()
    {
        $data = PostSearch::getAll(5);
         $popular = PostSearch::getPopular();
          $recent = PostSearch::getRecent();


        return $this->render('index',[
            'posts'=>$data['posts'],
            'pagination'=>$data['pagination'],
            'popular'=>$popular,
            'recent'=>$recent,
            'categories'=>$categories
        ]);
    }*/

    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSetImage($id)
    {
        $model = new ImageUpload;

        if (Yii::$app->request->isPost)
        {
            $post = $this->findModel($id);
            $file = UploadedFile::getInstance($model, 'image');

            if($post->saveImage($model->uploadFile($file, $post->image)))
            {
                return $this->redirect(['view', 'id'=>$post->id]);
            }
        }

        return $this->render('image', ['model'=>$model]);
    }
}
