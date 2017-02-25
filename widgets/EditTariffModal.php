<?php

namespace halumein\servicemini\widgets;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use halumein\servicemini\models\Category;
use halumein\servicemini\models\Service;
use halumein\servicemini\models\ServiceToCategory as Tariff;
use yii;

class editTariffModal extends \yii\base\Widget
{

    public $tariffId = null;
    public $serviceId = null;
    public $categoryId = null;

    public function init()
    {
        parent::init();

    }

    public function run()
    {
        $url = Url::to(['update', 'id' => $this->tariffId]);

        if (!$model = Tariff::findOne($this->tariffId)) {
            $model = new Tariff;
            $url = Url::to(['create']);
        }

        $service = Service::findOne($this->serviceId);
        
        $category = Category::findOne($this->categoryId);
        
        $view = $this->getView();
        $view->on($view::EVENT_END_BODY, function($event) use ($model,$service,$category,$url) {
            echo $this->render('tariff_modal', [
                'model' => $model,
                'service' => $service,
                'category' => $category,
            ]);
        });
        
        return Html::a('<i href="'.$url.'" class="glyphicon glyphicon-pencil"></i>', '#tariffModal', ['title' => 'Тариф', 'data-toggle' => 'modal', 'data-target' => '#tariffModal']);
    }
}