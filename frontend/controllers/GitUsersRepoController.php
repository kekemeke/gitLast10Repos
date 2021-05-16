<?php
declare(strict_types=1);

namespace frontend\controllers;

use common\models\GitUsersRepo;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class GitUsersRepoController extends Controller
{
    public function actionIndex(): string
    {
        $dataProvider = new ActiveDataProvider([
            'query' => GitUsersRepo::find(),
            'sort' => [
                'attributes' => [
                    'updated_at'
                ],
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
