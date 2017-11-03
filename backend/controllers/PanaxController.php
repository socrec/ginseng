<?php

namespace backend\controllers;

use common\constant\App;
use common\constant\Auth;
use common\models\Image;
use common\models\YearlyDetail;
use Yii;
use common\models\Ginseng;
use common\models\GinsengSearch;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * PanaxController implements the CRUD actions for Ginseng model.
 */
class PanaxController extends Controller
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
                        'actions' => ['index', 'view', 'panax-list'],
                        'allow' => true,
                        'roles' => [Auth::PERM_VIEW_GINSENG]
                    ],
                    [
                        'actions' => ['update'],
                        'allow' => true,
                        'roles' => [Auth::PERM_EDIT_GINSENG],
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => [Auth::PERM_ADD_GINSENG],
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => [Auth::PERM_DELETE_GINSENG],
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
     * Lists all Ginseng models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GinsengSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPanaxList($q = null, $id = null) {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = new Query();
            $query->select('id, code AS text')
                ->from('ginseng')
                ->where(['like', 'code', $q])
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => Ginseng::findOne($id)->code];
        }
        return $out;
    }

    /**
     * Displays a single Ginseng model.
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
     * Creates a new Ginseng model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Ginseng();
        $yearlyModel = new YearlyDetail();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->code = 'PV' . strtoupper(uniqid());
            $model->save();

            //upload Image
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            foreach ($model->imageFiles as $file) {
                $path = 'uploads/panax/'. uniqid() . '_' . $file->baseName . '.' . $file->extension;
                $file->saveAs($path);

                //save to db
                $image = new Image();
                $image->path = $path;
                $image->object_id = $model->id;
                $image->object_type = App::OBJECT_PANAX;
                $image->save();
            }

            $data = Yii::$app->request->post('YearlyDetail');
            if (count($data['year']) && $data['year'][0]) {
                foreach ($data['year'] as $index => $year) {
                    $yearlyModel = new YearlyDetail();
                    $yearlyModel->year = $year;
                    $yearlyModel->ginseng_id = $model->id;
                    $yearlyModel->date_raise = $data['date_raise'][$index];
                    $yearlyModel->date_sleep = $data['date_sleep'][$index];
                    $yearlyModel->fertilize_date = $data['fertilize_date'][$index];
                    $yearlyModel->fertilize_brand = $data['fertilize_brand'][$index];
                    $yearlyModel->fertilize_amount = $data['fertilize_amount'][$index];
                    $yearlyModel->save();
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', compact('model', 'yearlyModel'));
        }
    }

    /**
     * Updates an existing Ginseng model.     * If update is successful, the browser will be redirected to the 'view' page.

     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Ginseng model.
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
     * Finds the Ginseng model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ginseng the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $model = Ginseng::findOne([
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
