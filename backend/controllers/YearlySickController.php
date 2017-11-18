<?php

namespace backend\controllers;

use common\constant\Auth;
use common\models\YearlySick;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class YearlySickController extends \yii\web\Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => [Auth::PERM_ADD_GINSENG],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'create' => ['POST'],
                ],
            ],
        ];
    }

    public function actionCreate()
    {
        $model = new YearlySick();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

        }
        return $this->render('create');
    }
}
