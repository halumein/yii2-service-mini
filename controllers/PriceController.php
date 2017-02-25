<?php

namespace halumein\servicemini\controllers;

use Yii;
use yii\base\Model;
use halumein\servicemini\models\Service;
use halumein\servicemini\models\Category;
use halumein\servicemini\models\ServiceToCategory;
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
        $tariffs = ServiceToCategory::find()->all();

        return $this->render('index', [
            'services' => $services,
            'categories' => $categories,
            'tariffs' => $tariffs,
        ]);

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

    public function actionSaveTariffGrid()
    {
        $tariffGrid = yii::$app->request->post('tariffGrid');
        foreach ($tariffGrid as $key => $tariff) {
            $model = ServiceToCategory::find()
                ->where([
                    'service_id' => $tariff['service_id'],
                    'category_id' => $tariff['category_id']
                ])
                ->one();
            
            if (!$model) {
                $model = new ServiceToCategory;
                $model->service_id = $tariff['service_id'];
                $model->category_id = $tariff['category_id'];
            }
            $model->price = $tariff['price'];
            $model->max_discount = $tariff['discount'];
            $model->save();
        }


    }

    protected function findModel($id)
    {
        if (($model = ServiceToCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}