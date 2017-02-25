<?php

namespace halumein\servicemini\widgets;

use yii\helpers\Html;
use halumein\servicemini\models\Category;
use halumein\servicemini\models\Service;
use halumein\servicemini\models\ServiceToCategory as Tariff;
use yii;

class editTariffModal extends \yii\base\Widget
{

    public function init()
    {
        parent::init();

    }

    public function run()
    {
        $model = new Tariff;
        $services = Service::find()->all();
        $categories = Category::find()->all();
        
        $view = $this->getView();
        $view->on($view::EVENT_END_BODY, function($event) use ($model,$services,$categories) {
            echo $this->render('tariff_modal', [
                'model' => $model,
                'services' => $services,
                'categories' => $categories,
            ]);
        });
        
        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '#tariffModal', ['title' => 'Тариф', 'data-toggle' => 'modal', 'data-target' => '#tariffModal', 'class' => 'btn btn-success']);
    }
}