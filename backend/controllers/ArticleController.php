<?php

namespace backend\controllers;

use common\constant\App;
use common\constant\Auth;
use common\models\Image;
use Yii;
use common\models\Article;
use common\models\AricleSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
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
                        'roles' => [Auth::PERM_VIEW_ARTICLE]
                    ],
                    [
                        'actions' => ['update'],
                        'allow' => true,
                        'roles' => [Auth::PERM_EDIT_ARTICLE],
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => [Auth::PERM_ADD_ARTICLE],
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => [Auth::PERM_DELETE_ARTICLE],
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
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AricleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Article();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //upload Image
            $file = UploadedFile::getInstance($model, 'imageFile');
            $path = 'uploads/article/' . uniqid() . '_' . $file->baseName . '.' . $file->extension;
            $file->saveAs($path);

            //save to db
            $image = new Image();
            $image->path = $path;
            $image->object_id = $model->id;
            $image->object_type = App::OBJECT_ARTICLE;
            $image->save();

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //upload Image
            $file = UploadedFile::getInstance($model, 'imageFile');
            if ($file)  {
                $oldImage = Image::find()->where(['object_type' => App::OBJECT_ARTICLE, 'object_id' => $model->id])->one();
                $oldImage->delete();

                $path = 'uploads/article/' . uniqid() . '_' . $file->baseName . '.' . $file->extension;
                $file->saveAs($path);

                //save to db
                $image = new Image();
                $image->path = $path;
                $image->object_id = $model->id;
                $image->object_type = App::OBJECT_ARTICLE;
                $image->save();
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->softDelete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
