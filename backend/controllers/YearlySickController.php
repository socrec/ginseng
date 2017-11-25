<?php

namespace backend\controllers;

use common\constant\App;
use common\constant\Auth;
use common\models\Image;
use common\models\YearlySick;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;
use yii\web\UploadedFile;

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
            $model->save();

            //upload Image
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            foreach ($model->imageFiles as $file) {
                $path = 'uploads/sick/' . uniqid() . '_' . $file->baseName . '.' . $file->extension;
                $file->saveAs($path);

                //save to db
                $image = new Image();
                $image->path = $path;
                $image->object_id = $model->id;
                $image->object_type = App::OBJECT_SICK;
                $image->save();
            }
        }
        return $this->redirect(['panax/view', 'id' => $model->yearlyDetail->ginseng_id]);
    }
}
