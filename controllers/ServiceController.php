<?php

namespace halumein\servicemini\controllers;

use Yii;
use halumein\servicemini\models\Service;
use halumein\servicemini\models\ServiceToCategory as Tariff;
use yii\helpers\ArrayHelper;
use halumein\servicemini\models\search\ServiceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ServiceMiniController implements the CRUD actions for Service model.
 */
class ServiceController extends Controller
{
    public function behaviors()
    {
        $behaviors = [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => $this->module->adminRoles,
                    ]
                ]
            ]
        ];

        return $behaviors;
    }


    /**
     * Lists all ServiceMini models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ServiceSearch();
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
        $model = new Service();
        $services = Service::find()->where("id != :id AND (parent_id = 0 OR parent_id IS NULL)", [':id' => (int)$model->id])->all();
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

        $services = Service::find()->where("id != :id AND (parent_id = 0 OR parent_id IS NULL)", [':id' => (int)$model->id])->all();
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

        $this->deleteTariffByServiceId($id);

        return $this->redirect(['index']);
    }

    /**
     * Finds the ServiceMini model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Service the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Service::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function deleteTariffByServiceId($serviceId)
    {
        Tariff::deleteAll(['service_id' => $serviceId]);
    }
}
