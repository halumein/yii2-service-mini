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

        $count = count(Yii::$app->request->post('ServiceToCategory', []));
        $tariffs = [new ServiceToCategory()];
        for($i = 1; $i < $count; $i++) {
            $tariffs[] = new ServiceToCategory();
        }

        $services = Service::find()->all();
        $categories = Category::find()->all();
        $tariffs = ServiceToCategory::find()->indexBy('id')->all();
        $tariff_model = ServiceToCategory::className();

        if (Model::loadMultiple($tariffs, Yii::$app->request->post()) && Model::validateMultiple($tariffs)) {
            foreach ($tariffs as $tariff) {
                $tariff->save(false);
            }
            return $this->redirect('index');
        }

        return $this->render('index',[
           'services' => $services,
            'categories' => $categories,
            'tariffs' => $tariffs,
            'tariff_model' => $tariff_model,
        ]);

    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $services = ArrayHelper::map(Service::find()->all(),'id','name');

        $categories = ArrayHelper::map(Category::find()->all(),'id','name');
        
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

    protected function findModel($id)
    {
        if (($model = ServiceToCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}