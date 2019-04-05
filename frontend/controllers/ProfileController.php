<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\Post;
use common\models\Category;

class ProfileController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
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
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $model = $this->findModel();
        $popular = Post::getPopular();
        $recent = Post::getRecent();
        $categories = Category::getAll();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('index', [
                'model' => $model,
                'popular'=>$popular,
                'recent'=>$recent,
                'categories'=>$categories,
        ]);
    }

    public function actionUpdate()
    {
        $model = $this->findModel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete()
    {
        $this->findModel()->delete();

        return $this->redirect(['index']);
    }

    /**
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    private function findModel()
    {
        if (($model = User::findOne(Yii::$app->user->id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
