<?php

namespace giicms\post\controllers;

use yii\web\Controller;
use yii\data\ActiveDataProvider;
use giicms\post\models\Post;

class DefaultController extends Controller {

    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => Post::find()->where(['type' => 'post'])->orderBy('id DESC'),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->view->title = 'News';
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

}
