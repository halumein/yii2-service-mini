<?php

namespace halumein\servicemini\controllers;

use Yii;
use halumein\servicemini\models\ServiceMini;
use yii\helpers\ArrayHelper;
use halumein\servicemini\models\search\ServiceMiniSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ServiceMiniController implements the CRUD actions for ServiceMini model.
 */
class ServiceMiniController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ServiceMini models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ServiceMiniSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    

    /**
     * Creates a new ServiceMini model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ServiceMini();
        $services = ServiceMini::find()->where("id != :id AND (parent_id = 0 OR parent_id IS NULL)", [':id' => (int)$model->id])->all();
        $services = ArrayHelper::map($services, 'id', 'name');
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index');
        } else {
            return $this->render('create', [
                'model' => $model,
                'services' => $services,
            ]);
        }
    }

    /**
     * Updates an existing ServiceMini model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $services = ServiceMini::find()->where("id != :id AND (parent_id = 0 OR parent_id IS NULL)", [':id' => (int)$model->id])->all();
        $services = ArrayHelper::map($services, 'id', 'name');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index');
        } else {
            return $this->render('update', [
                'model' => $model,
                'services' => $services,
            ]);
        }
    }

    /**
     * Deletes an existing ServiceMini model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ServiceMini model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ServiceMini the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ServiceMini::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
