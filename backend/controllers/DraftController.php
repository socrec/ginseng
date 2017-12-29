<?php

namespace backend\controllers;

use common\constant\App;
use common\constant\Auth;
use common\models\DraftYear;
use common\models\Ginseng;
use common\models\Image;
use common\models\YearlyDetail;
use Yii;
use common\models\DraftGinseng;
use common\models\DraftGinsengSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * DraftController implements the CRUD actions for DraftGinseng model.
 */
class DraftController extends Controller
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
                        'actions' => ['index', 'view'],
                        'allow' => true,
                        'roles' => [Auth::PERM_VIEW_DRAFT]
                    ],
                    [
                        'actions' => ['create', 'update'],
                        'allow' => true,
                        'roles' => [Auth::PERM_ADD_DRAFT],
                    ],
                    [
                        'actions' => ['approve'],
                        'allow' => true,
                        'roles' => [Auth::PERM_APPROVE_DRAFT],
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => [Auth::PERM_DELETE_DRAFT],
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

    /**
     * Lists all DraftGinseng models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DraftGinsengSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DraftGinseng model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Draft model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DraftGinseng();
        $model->scenario = 'create';
        $yearlyModel = new DraftYear();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //upload Image
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            foreach ($model->imageFiles as $file) {
                $path = 'uploads/panax/' . uniqid() . '_' . $file->baseName . '.' . $file->extension;
                $file->saveAs($path);

                //save to db
                $image = new Image();
                $image->path = $path;
                $image->object_id = $model->id;
                $image->object_type = App::OBJECT_DRAFT;
                $image->save();
            }

            $data = Yii::$app->request->post('DraftGinseng');
            if (count($data['years']) && $data['years'][0]['year']) {
                foreach ($data['years'] as $index => $yearlyDetail) {
                    $yearlyModel = new DraftYear();
                    $yearlyModel->year = $yearlyDetail['year'];
                    $yearlyModel->draft_id = $model->id;
                    $yearlyModel->date_raise = $yearlyDetail['date_raise'];
                    $yearlyModel->date_sleep = $yearlyDetail['date_sleep'];
                    $yearlyModel->fertilize_date = $yearlyDetail['fertilize_date'];
                    $yearlyModel->fertilize_brand = $yearlyDetail['fertilize_brand'];
                    $yearlyModel->fertilize_amount = $yearlyDetail['fertilize_amount'];
                    $yearlyModel->save();
                }
            }
            Yii::$app->session->setFlash('alert', Yii::t('app', 'Your update created successfully. Please wait for admin\'s approval.'));
            return $this->redirect(['panax/index']);
        } else {
            return $this->render('create', compact('model', 'yearlyModel'));
        }
    }

    /**
     * Updates an existing Ginseng model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $ginsengModel = PanaxController::findModel($id);
        $model = cloneModel(DraftGinseng::className(), $ginsengModel, ['id']);
        $model->ginseng_id = $id;

        $yearlyModel = new DraftYear();
        if ($ginsengModel->id && $ginsengModel->getYearlyDetails()->count()) {
            $model->years = $ginsengModel->getYearlyDetails()->all();
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            dd('ok');
            $model->save();

            //upload Image
            $imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            if (count($imageFiles)) {
                //delete all old images
                $oldImages = Image::find()->where(['object_type' => App::OBJECT_DRAFT, 'object_id' => $model->id])->all();
                if (count($oldImages)) {
                    foreach ($oldImages as $oldImage) {
                        $oldImage->delete();
                    }
                }

                //upload new files
                foreach ($imageFiles as $file) {
                    $path = 'uploads/panax/' . uniqid() . '_' . $file->baseName . '.' . $file->extension;
                    $file->saveAs($path);

                    //save to db
                    $image = new Image();
                    $image->path = $path;
                    $image->object_id = $model->id;
                    $image->object_type = App::OBJECT_DRAFT;
                    $image->save();
                }
            }

            $data = Yii::$app->request->post('DraftGinseng');

            //update yearly details
            if (count($data['years']) && $data['years'][0]) {
                foreach ($data['years'] as $index => $yearlyDetail) {
                    $yearlyModel = new DraftYear();
                    $yearlyModel->year = $yearlyDetail['year'];
                    $yearlyModel->draft_id = $model->id;
                    $yearlyModel->date_raise = $yearlyDetail['date_raise'];
                    $yearlyModel->date_sleep = $yearlyDetail['date_sleep'];
                    $yearlyModel->fertilize_date = $yearlyDetail['fertilize_date'];
                    $yearlyModel->fertilize_brand = $yearlyDetail['fertilize_brand'];
                    $yearlyModel->fertilize_amount = $yearlyDetail['fertilize_amount'];
                    $yearlyModel->notice = $yearlyDetail['notice'];
                    $yearlyModel->save();
                }
            }
            Yii::$app->session->setFlash('alert', Yii::t('app', 'Your update created successfully. Please wait for admin\'s approval.'));
            return $this->redirect(['panax/index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'yearlyModel' => $yearlyModel,
            ]);
        }
    }

    public function actionApprove($id)
    {
        $model = $this->findModel($id);
        if ($model->ginseng_id) {
            $ginsengModel = PanaxController::findModel($model->ginseng_id);
            if ($ginsengModel) {
                $attributes = $model->attributes;
                unset($attributes['ginseng_id']);
                unset($attributes['id']);
                foreach($attributes as  $attribute => $val) {
                    $ginsengModel->{$attribute} = $val;
                }
            }
            $ginsengModel->save();

            //delete all old year details
            $sicks = [];
            if (count($ginsengModel->yearlyDetails)) {
                foreach ($ginsengModel->yearlyDetails as $yearlyDetail ) {
                    $sicks[$yearlyDetail->year] = $yearlyDetail->sicks;
                    $yearlyDetail->softDelete();
                }
            }
            if (count($model->yearlyDetails)) {
                foreach ($model->yearlyDetails as $draftYear) {
                    $yearlyDetail = cloneModel(YearlyDetail::className(), $draftYear, ['draft_id', 'id']);
                    $yearlyDetail->ginseng_id = $ginsengModel->id;
                    $yearlyDetail->save();

                    //update all the sick to new details
                    if ($sicks[$yearlyDetail->year]) {
                        foreach ($sicks[$yearlyDetail->year] as $sick) {
                            $sick->year_id = $yearlyDetail->id;
                            $sick->save();
                        }
                    }
                    //END update all the sick to new details
                }
            }
        } else {
            $ginsengModel = cloneModel(Ginseng::className(), $model, ['ginseng_id'], ['id']);
            $ginsengModel->save();

            if (count($model->yearlyDetails)) {
                foreach ($model->yearlyDetails as $draftYear) {
                    $yearlyDetail = cloneModel(YearlyDetail::className(), $draftYear, ['draft_id', 'id']);
                    $yearlyDetail->ginseng_id = $ginsengModel->id;
                    $yearlyDetail->save();
                }
            }
        }

        //copy images
        if (count($model->images)) {
            foreach ($model->images as $image) {
                $image->object_type = App::OBJECT_PANAX;
                $image->object_id = $ginsengModel->id;
                $image->save();
            }
        }
        $model->softDelete();
        Yii::$app->session->setFlash('alert', Yii::t('app', 'Approved successfully.'));
        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing DraftGinseng model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->softDelete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DraftGinseng model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DraftGinseng the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $model = DraftGinseng::findOne([
            'id' => $id,
            'is_deleted' => null
        ]);
        if ($model !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
