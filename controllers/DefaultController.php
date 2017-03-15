<?php

namespace halumein\servicemini\controllers;

use yii\web\Controller;
use yii\filters\VerbFilter;

use yii\filters\AccessControl;


/**
 * Default controller for
 */
class DefaultController extends Controller
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
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }


}
