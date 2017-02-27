<?php

namespace halumein\servicemini\controllers;

use Yii;
use yii\base\Model;
use halumein\servicemini\models\Service;
use halumein\servicemini\models\Category;
use halumein\servicemini\models\ServiceToCategory as Tariff;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;

class PriceController extends Controller
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

    public function actionIndex()
    {

        $services = Service::find()->all();
        $categories = Category::find()->all();
        $tariffs = Tariff::find()->all();

        return $this->render('index', [
            'services' => $services,
            'categories' => $categories,
            'tariffs' => $tariffs,
        ]);

    }

    public function actionCreate()
    {

        $model = new Tariff;

        $services = ArrayHelper::map(Service::find()->all(), 'id', 'name');

        $categories = ArrayHelper::map(Category::find()->all(), 'id', 'name');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index');
        } else {
            return $this->render('create', [
                'model' => $model,
                'services' => $services,
                'categories' => $categories,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $services = ArrayHelper::map(Service::find()->all(), 'id', 'name');

        $categories = ArrayHelper::map(Category::find()->all(), 'id', 'name');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index');
        } else {
            return $this->render('update', [
                'model' => $model,
                'services' => $services,
                'categories' => $categories,
            ]);
        }
    }

    public function actionAjaxModelLoad()
    {
        $data = yii::$app->request->post();

        if (!$model = Tariff::find()->where(['service_id' => $data['service_id'], 'category_id' => $data['category_id']])->one()) {
            $model = new Tariff;
        }

        $service = Service::findOne($data['service_id']);

        $category = Category::findOne($data['category_id']);

        return $this->renderAjax('_modal-content', [
            'model' => $model,
            'service' => $service,
            'category' => $category,
        ]);
    }

    public function actionSaveTariffGrid()
    {
        $tariffGrid = yii::$app->request->post('tariffGrid');
        foreach ($tariffGrid as $key => $tariff) {
            $model = Tariff::find()
                ->where([
                    'service_id' => $tariff['service_id'],
                    'category_id' => $tariff['category_id']
                ])
                ->one();

            if (!$model) {
                $model = new Tariff;
                $model->service_id = $tariff['service_id'];
                $model->category_id = $tariff['category_id'];
            }
            $model->price = $tariff['price'];
            $model->max_discount = $tariff['discount'];
            $model->save();
        }

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return [
            'status' => 'success',
        ];

    }

    protected function findModel($id)
    {
        if (($model = Tariff::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}